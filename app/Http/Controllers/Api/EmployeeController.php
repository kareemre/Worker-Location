<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Info(
 *     title="Worker API",
 *     version="1.0.0"
 * )
 */
class EmployeeController extends Controller
{


    /**
     * an instance of EmployeeService
     * @var \App\Services\EmployeeService
     */
    protected $employeeService;


    /**
     * constructor for setting the EmployeeService 
     * 
     * @param EmployeeService $employeeService
     */
    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }




    /**
     * @OA\Get(
     *      path="/api/worker/clock-ins",
     *      tags={"get-worker-clockins"},
     *      summary="Get an employee by ID",
     *      description="Returns a single employee resource identified by the given ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="query",
     *          required=true,
     *          description="ID of the employee",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/EmployeeResource"
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Missing required parameter: id",
     *          @OA\JsonContent(
     *              example={"message": "Missing required parameter: id"}
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Employee not found",
     *          @OA\JsonContent(
     *              example={"message": "Employee not found"}
     *          )
     *      )
     * )
     * 
     * 
     *     
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
     * @OA\Post(
     *     path="/api/worker/clock-in",
     *     tags={"post-worker-clock-in"},
     *     summary="clock-in an worker",
     *     description="clock-in an employee after validationg it's location",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/EmployeeRequest")
     *     ),
     * 
     *     @OA\Response(
     *          response=422,
     *          description="Validation error",
     *          @OA\JsonContent(
     *              example={"message": "Validation Error"}
     *          )
     * ),
     *     @OA\Response(
     *         response=201,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/EmployeeResource")
     *     )
     * )
     * 
     * 
     *     
     * Validate the request and call the EmployeeService to apply business logic
     * 
     * @param EmployeeRequest $request
     * 
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */

    public function store(EmployeeRequest $request)
    {

        $requestData = $request->validated();

        $data = $this->employeeService->clockEmployeeIn($requestData);

        return new EmployeeResource($data);
        
    }
}
