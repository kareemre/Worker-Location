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
        return Employee::create($data);
    }

}
