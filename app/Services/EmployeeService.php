<?php

namespace App\Services;

use App\Models\Employee;

class EmployeeService
{

    /**
     * this method first checks if the employee within the specific range 
     * (i.e did not exceed 2 kilometers distance)
     *  
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function clockEmployeeIn(array $data)
    {
        $deltaDistance = $this->evaluateLocation(
            30.049611,
            31.240253,
            $data['latitude'],
            $data['longitude'],
        );

        if ($deltaDistance > 2000) {
            throw new \Exception('Clock-in rejected: Location outside allowed area (distance: ' . $deltaDistance . ' meters)');
        }

        return Employee::create($data);
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

        // Earth radius in kilometers
        $earthRadius = 6371; 

        //converting latitude from degree to radian
        $differenceLat  = deg2rad($defaultLat - $employeeLat); 

        //converting longitude from degree to radian
        $differenceLong = deg2rad($defaultlong - $employeeLong); 

        $halfChordSquared = sin($differenceLat / 2) * sin($differenceLat / 2) +
            cos(deg2rad($employeeLat)) * cos(deg2rad($defaultLat)) *
            sin($differenceLong / 2) * sin($differenceLong / 2);

        $centralAngle = 2 * atan2(sqrt($halfChordSquared), sqrt(1 - $halfChordSquared));

        return $differenceInMeters =  $earthRadius * $centralAngle * 1000; //return distance in meters
    }
}
