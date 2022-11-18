<?php

namespace App\Service\Filter;

use Illuminate\Http\Request;

class TokenSearchFilter implements TokenSearchFilterInterface
{
    use Paginable;

    const REQUEST_PARAMETER_TAG = 'tag';
    const REQUEST_PARAMETER_NAME = 'name';
    const REQUEST_PARAMETER_DESCRIPTION = 'description';
    const REQUEST_PARAMETER_LNG = 'lng';
    const REQUEST_PARAMETER_LAT = 'lat';
    const REQUEST_PARAMETER_RADIUS = 'radius';

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
     * @var float
     */
    public float $lat;

    /**
     * @var float
     */
    public float $lng;

    /**
     * @var float|int
     */
    public float|int $radius = 1;

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
     * @param float $lat
     */
    public function setLat(float $lat): void
    {
        $this->lat = $lat;
    }

    /**
     * @return float
     */
    public function getLat(): float
    {
        return $this->lat;
    }

    /**
     * @param float $lng
     */
    public function setLng(float $lng): void
    {
        $this->lng = $lng;
    }

    /**
     * @return float
     */
    public function getLng(): float
    {
        return $this->lng;
    }

    /**
     * @param int|float $radius
     */
    public function setRadius(int|float $radius): void
    {
        $this->radius = $radius;
    }

    /**
     * @return float
     */
    public function getRadius(): float
    {
        return $this->radius;
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

    /**
     *
     * @param Request $request
     */
    public function mapRequestGeoFields(Request $request): void
    {
        $this->mapRequestPaginableFields($request);

        if ($request->has(self::REQUEST_PARAMETER_LAT)) {
            $this->setLat($request->get(self::REQUEST_PARAMETER_LAT));
        }
        if ($request->has(self::REQUEST_PARAMETER_LNG)) {
            $this->setLng($request->get(self::REQUEST_PARAMETER_LNG));
        }
        if ($request->has(self::REQUEST_PARAMETER_RADIUS)) {
            $this->setRadius($request->get(self::REQUEST_PARAMETER_RADIUS));
        }
    }
}
