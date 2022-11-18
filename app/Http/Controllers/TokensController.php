<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetTokenFiltersRequest;
use App\Http\Requests\GetTokenGeolocationsRequest;
use App\Http\Resources\Token\TokenCollectionResource;
use App\Repositories\TokenRepositoryInterface;
use App\Service\Filter\TokenSearchFilter;

class TokensController
{
    /**
     * @param GetTokenFiltersRequest $request
     * @param TokenRepositoryInterface $tokenRepository
     *
     * @return TokenCollectionResource
     */
    public function index(
        GetTokenFiltersRequest $request,
        TokenRepositoryInterface $tokenRepository
    ): TokenCollectionResource
    {
        $tokenSearchFilter = new TokenSearchFilter();
        $tokenSearchFilter->mapRequestFields($request);

        $tokens = $tokenRepository->getPaginatedCollectionByFilter($tokenSearchFilter);

        return new TokenCollectionResource($tokens);
    }

    /**
     * @param GetTokenGeolocationsRequest $request
     * @param TokenRepositoryInterface $tokenRepository
     *
     * @return TokenCollectionResource
     */
    public function geoSearch(
        GetTokenGeolocationsRequest $request,
        TokenRepositoryInterface $tokenRepository
    ): TokenCollectionResource
    {
        $tokenSearchFilter = new TokenSearchFilter();
        $tokenSearchFilter->mapRequestGeoFields($request);

        $tokens = $tokenRepository->getPaginatedCollectionByGeoFilter($tokenSearchFilter);

        return new TokenCollectionResource($tokens);
    }
}
