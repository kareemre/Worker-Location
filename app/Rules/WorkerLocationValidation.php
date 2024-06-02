<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class WorkerLocationValidation implements ValidationRule, DataAwareRule
{


    /**
     * Radius of Earth.
     *
     * @const int
     */
    const EARTH_RADIUS = 6371;


     /**
     * Range of Working Area.
     *
     * @const int
     */
    const AREA_RANGE = 2000;


    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];



    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value <= 0 || $this->data['longitude'] <= 0 || ! $this->isWithinRange($value, $this->data['longitude'])) {

            $fail('Invalid location');

        } 
    }



    /**
     * @param mixed $lat
     * @param mixed $long
     * 
     * @return bool
     */
    private function isWithinRange($lat, $long)
    {
       return $deltaDistance = ($this->evaluateLocation(
            30.049611,
            31.240253,
            $lat,
            $long
        ) < static::AREA_RANGE) ? true : false;

    }



    /**
     * this method calculates the difference between the employee location and the working area in meters
     * working area location coordinates are hard coded 
     * 
     * @param float $defaultLat
     * @param float $defaultlong
     * @param float $employeeLat
     * @param float $employeeLong
     * 
     * @return int $differenceInMeters
     */
    private function evaluateLocation($defaultLat, $defaultlong, $employeeLat, $employeeLong)
    {

        //converting latitude from degree to radian
        $differenceLat  = deg2rad($defaultLat - $employeeLat);

        //converting longitude from degree to radian
        $differenceLong = deg2rad($defaultlong - $employeeLong);

        $halfChordSquared = sin($differenceLat / 2) * sin($differenceLat / 2) +
            cos(deg2rad($employeeLat)) * cos(deg2rad($defaultLat)) *
            sin($differenceLong / 2) * sin($differenceLong / 2);

        $centralAngle = 2 * atan2(sqrt($halfChordSquared), sqrt(1 - $halfChordSquared));

        return $differenceInMeters =  self::EARTH_RADIUS * $centralAngle * 1000; //return distance in meters
    }


    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }
}
