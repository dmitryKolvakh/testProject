<?php namespace App\Service;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class GeoService
{
    /**
     * @var int
     */
    public int $circleRadius;

    /**
     * @var string
     */
    private string $latitudeColumn;

    /**
     * @var string
     */
    private string $longitudeColumn;

    public function __construct(string $latitudeColumn, string $longitudeColumn, int $circleRadius = 3000)
    {
        $this->latitudeColumn = $latitudeColumn;
        $this->longitudeColumn = $longitudeColumn;
        $this->circleRadius = $circleRadius;
    }

    public function applyDistanceConstraints(Builder $query, float $lat, float $lng, $maximum_distance, $boolean = 'and')
    {
        $query->orderBy($this->getDbDistanceStatement($lat, $lng), 'ASC');
        $query->where($this->getDbDistanceStatement($lat, $lng), '<=', $maximum_distance, $boolean);
    }

    /**
     * @param float $lat
     * @param float $lng
     * @return \Illuminate\Database\Query\Expression
     */
    public function getDbDistanceStatement(float $lat, float $lng)
    {
        return DB::raw($this->getDistanceStatement($lat, $lng));
    }

    /**
     * @param float $lat
     * @param float $lng
     * @return string
     */
    public function getDistanceStatement(float $lat, float $lng): string
    {
        return <<<SELECT
            ROUND (
              (
                {$this->circleRadius}
                *
                acos (
                  cos(radians($lat)) * cos(radians($this->latitudeColumn))
				  * cos(radians($this->longitudeColumn) - radians($lng))
				  + sin(radians($lat)) * sin(radians($this->latitudeColumn))
				)
			  )
        	, 2)
SELECT;
    }
}
