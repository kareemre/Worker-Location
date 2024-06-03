<?php

namespace App\Http\Resources;

use App\Managers\JsonResourceManager;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResourceManager
{
     const DATA = ['id', 'arrival_time', 'latitude', 'longitude'];
}
