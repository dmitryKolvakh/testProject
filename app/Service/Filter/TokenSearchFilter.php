<?php

namespace App\Service\Filter;

use Illuminate\Http\Request;

class TokenSearchFilter implements TokenSearchFilterInterface
{
    use Paginable;

    const REQUEST_PARAMETER_TAG = 'tag';
    const REQUEST_PARAMETER_NAME = 'name';
    const REQUEST_PARAMETER_DESCRIPTION = 'description';

    /**
     * @var null|string
     */
    public ?string $description = null;

    /**
     * @var null|string
     */
    public ?string $tag = null;

    /**
     * @var null|string
     */
    public ?string $name = null;

    /**
     * @param null|string $tag
     */
    public function setTag(?string $tag): void
    {
        $this->tag = $tag;
    }

    /**
     * @return string|null
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * @param null|string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     *
     * @param Request $request
     */
    public function mapRequestFields(Request $request): void
    {
        $this->mapRequestPaginableFields($request);

        if ($request->has(self::REQUEST_PARAMETER_TAG)) {
            $this->setTag($request->get(self::REQUEST_PARAMETER_TAG));
        }
        if ($request->has(self::REQUEST_PARAMETER_NAME)) {
            $this->setName($request->get(self::REQUEST_PARAMETER_NAME));
        }
        if ($request->has(self::REQUEST_PARAMETER_DESCRIPTION)) {
            $this->setDescription($request->get(self::REQUEST_PARAMETER_DESCRIPTION));
        }
    }
}
