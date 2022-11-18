<?php

namespace App\Service;

use Location\Coordinate;
use Location\Distance\Vincenty;

class GeoValidationService
{
    const KILOMETER = 1000;
    const MILE = 1609;

    /**
     * @param array $fistPoint
     * @param array $secondPoint
     * @param int $circleRadius
     * @param bool $isMile
     * @return bool
     */
    public static function inCircleRadius(array $fistPoint, array $secondPoint, int $circleRadius, bool $isMile = true): bool
    {
        return $circleRadius && self::getDistance($fistPoint, $secondPoint) < ($circleRadius * ($isMile ? self::MILE : self::KILOMETER));
    }

    /**
     * @param array $fistPoint
     * @param array $secondPoint
     * @return float
     */
    public static function getDistance(array $fistPoint, array $secondPoint) :float
    {
        $coordinateFist = new Coordinate($fistPoint['lat'], $fistPoint['lng']);
        $coordinateSecond = new Coordinate($secondPoint['lat'], $secondPoint['lng']);

        return (new Vincenty())->getDistance($coordinateFist, $coordinateSecond);
    }
}
