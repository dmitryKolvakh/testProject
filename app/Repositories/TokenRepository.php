<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Models\Token;
use App\Service\Filter\TokenSearchFilter;
use Illuminate\Database\Eloquent\Builder;
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

        //dd($paginated->setCollection($paginated->getCollection()));
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

}
