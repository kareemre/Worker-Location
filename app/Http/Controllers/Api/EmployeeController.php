<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\Request;


class EmployeeController extends Controller
{

    /** 
     * getting the employee by id
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */

    public function show(Request $request)
    {

        $id = $request->query('id');

        if (! $id) {

            return response()->json(['message' => 'Missing required parameter: id'], 400);
        }

        $employee = Employee::findOrFail($id);

        return new EmployeeResource($employee);

    }



    /**
     * Validate the request and clock-in the worker
     * 
     * @param EmployeeRequest $request
     * 
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */

    public function store(EmployeeRequest $request)
    {

        $requestData = $request->validated();

        $data = Employee::create($requestData);

        return new EmployeeResource($data);
        
    }
}
