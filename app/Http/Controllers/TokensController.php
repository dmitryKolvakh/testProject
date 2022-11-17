<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetTokenFiltersRequest;
use App\Http\Resources\Token\TokenCollectionResource;
use App\Repositories\TokenRepositoryInterface;
use App\Service\Filter\TokenSearchFilter;

class TokensController
{
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
}
