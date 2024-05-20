<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{

    /**
     *@OA\Schema(
     *     schema="EmployeeResource",
     *     type="object",
     *     title="Employee Resource",
     *     required={"id", "arrival_time", "latitude", "longitude"},
     *     @OA\Property(
     *         property="id",
     *         type="integer",
     *         description="ID of the user"
     *     ),
     *      @OA\Property(
     *         property="arrival_time",
     *         type="string",
     *         description="Name of the user"
     *     ),
     *    @OA\Property(
     *         property="latitude",
     *         type="decimal",
     *         description="latitude of the worker"
     *     ),
     *          @OA\Property(
     *         property="longitude",
     *         type="decimal",
     *         description="longitude of the worker"
     *     )
     * )
     * 
     * 
     *     
     *Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'arrival_time' => $this->arrival_time,
            'latitude'     => $this->latitude,
            'longitude'    => $this->longitude,
        ];
    }
}
