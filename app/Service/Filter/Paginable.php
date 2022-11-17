<?php

namespace App\Service\Filter;

use Illuminate\Http\Request;

trait Paginable
{

    /**
     * @var int
     */
    protected int $page = 1;

    /**
     * @var int
     */
    protected int $perPage = 10;

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return void
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * @param int $perPage
     * @return void
     */
    public function setPerPage(int $perPage): void
    {
        $this->perPage = $perPage;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function mapRequestPaginableFields(Request $request): void
    {
        if ($request->has(PaginableInterface::PAGE_FIELD)) {
            $this->setPage($request->input(PaginableInterface::PAGE_FIELD));
        }

        if ($request->has(PaginableInterface::PER_PAGE_FIELD)) {
            $this->setPerPage($request->input(PaginableInterface::PER_PAGE_FIELD));
        }
    }
}
