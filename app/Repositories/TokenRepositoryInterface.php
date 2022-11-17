<?php

namespace App\Repositories;

use App\Service\Filter\TokenSearchFilter;
use Illuminate\Pagination\LengthAwarePaginator;

interface TokenRepositoryInterface
{

    /**
     * @param TokenSearchFilter $tokenSearchFilter
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginatedCollectionByFilter(TokenSearchFilter $tokenSearchFilter): LengthAwarePaginator;

}
