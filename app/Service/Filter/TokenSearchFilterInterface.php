<?php

namespace App\Service\Filter;

use Illuminate\Http\Request;

interface TokenSearchFilterInterface
{

    /**
     * @param Request $request
     */
    public function mapRequestFields(Request $request): void;

    /**
     * @param string $description
     */
    public function setDescription(string $description): void;

    /**
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * @param string $name
     */
    public function setName(string $name): void;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string $tag
     */
    public function setTag(string $tag): void;

    /**
     * @return string|null
     */
    public function getTag(): ?string;
}
