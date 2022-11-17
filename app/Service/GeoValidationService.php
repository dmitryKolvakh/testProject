<?php

namespace App\Service;

use Location\Coordinate;
use Location\Distance\Vincenty;

class GeoValidationService
{
    /**
     * @param array $fistPoint
     * @param array $secondPoint
     * @param int $circleRadius
     * @return bool
     */
    public function inCircleRadius(array $fistPoint, array $secondPoint, int $circleRadius): bool
    {
        return $circleRadius && $this->getDistance($fistPoint, $secondPoint) > $circleRadius;
    }

    /**
     * @param array $fistPoint
     * @param array $secondPoint
     * @return float
     */
    public function getDistance(array $fistPoint, array $secondPoint) :float
    {
        $coordinateFist = new Coordinate($fistPoint['lat'], $fistPoint['lng']);
        $coordinateSecond = new Coordinate($secondPoint['lat'], $secondPoint['lng']);
        return (new Vincenty())->getDistance($coordinateFist, $coordinateSecond);
    }
}
