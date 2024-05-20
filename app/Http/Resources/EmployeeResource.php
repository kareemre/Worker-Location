<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{

    /**
     * @OA\Schema(
     *     schema="EmployeeResource",
     *     type="object",
     *     title="Employee Resource",
     *     @OA\Property(property="id", type="integer", example=123),
     *     @OA\Property(property="arrival_date", type="string", example="2024-05-15 20:38:35"),
     *     @OA\Property(property="latitude", type="string", example=30.049612),
     *     @OA\Property(property="longitude", type="string", example=31.240252),
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
