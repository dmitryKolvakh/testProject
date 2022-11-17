<?php

namespace App\Service\Filter;

interface PaginableInterface
{
    public const PAGE_FIELD = 'page';
    public const PER_PAGE_FIELD = 'per_page';
    public const WITH_PAGINATION_FIELD = 'with_pagination';

    /**
     * @param int $page
     * @return void
     */
    public function setPage(int $page): void;

    /**
     * @return int
     */
    public function getPage(): int;

    /**
     * @param int $page
     * @return void
     */
    public function setPerPage(int $page): void;

    /**
     * @return int
     */
    public function getPerPage(): int;
}
