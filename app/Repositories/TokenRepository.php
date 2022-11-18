<?php

namespace App\Repositories;

use App\Models\Token;
use App\Service\Filter\TokenSearchFilter;
use App\Service\GeoValidationService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TokenRepository implements TokenRepositoryInterface
{

    /**
     * @param TokenSearchFilter $tokenSearchFilter
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginatedCollectionByFilter(TokenSearchFilter $tokenSearchFilter): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $paginated */
        $paginated = $this->getQueryBuilderWithFilter($tokenSearchFilter)
            ->paginate(
                $tokenSearchFilter->getPerPage(),
                ['*'], 'page',
                $tokenSearchFilter->getPage()
            );

        return $paginated->setCollection($paginated->getCollection());
    }

    /**
     * @param TokenSearchFilter $filter
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getQueryBuilderWithFilter(TokenSearchFilter $filter): Builder
    {
        $builder = Token::query();
        $builder->select(Token::TABLE_NAME . '.*');


        if ($filter->getName()) {
            $builder->where(function (Builder $searchQuery) use ($filter) {
                $searchQuery->orWhere(Token::TABLE_NAME . '.name', 'LIKE', "%{$filter->getName()}%");
            });
        }

        if ($filter->getDescription()) {
            $builder->where(function (Builder $searchQuery) use ($filter) {
                $searchQuery->orWhere(Token::TABLE_NAME . '.description', 'LIKE', "%{$filter->getDescription()}%");
            });
        }

        if ($filter->getTag()) {
            $builder->with('tags')->orWhere('name', 'LIKE', "%{$filter->getTag()}%" )->get();
        }

        return $builder;
    }

    /**
     * @param TokenSearchFilter $tokenSearchFilter
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginatedCollectionByGeoFilter(TokenSearchFilter $tokenSearchFilter): LengthAwarePaginator
    {
        /** @var LengthAwarePaginator $paginated */
        $tokens = $this->getQueryBuilderWithGeoFilter($tokenSearchFilter);

        return new LengthAwarePaginator(
            $tokens->forPage($tokenSearchFilter->getPage(),
            $tokenSearchFilter->getPerPage()),
            $tokens->count(),
            $tokenSearchFilter->getPerPage(),
            $tokenSearchFilter->getPage()
        );
    }

    /**
     * @param TokenSearchFilter $filter
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getQueryBuilderWithGeoFilter(TokenSearchFilter $filter): Collection
    {
        $centerPoint = [
            'lat' => $filter->getLat(),
            'lng' => $filter->getLng(),
        ];

        return Token::all()->filter(function ($item) use ($centerPoint, $filter) {
            return GeoValidationService::inCircleRadius(
                $centerPoint,
                [
                'lat' => json_decode($item->location)->latitude,
                'lng' => json_decode($item->location)->longitude,
                ],
                $filter->getRadius()
            );
        })->values();
    }
}
