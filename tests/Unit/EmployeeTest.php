<?php

namespace Tests\Unit;

use App\Models\Employee;
use Mockery;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    /**
     * testing the post request of an employee clock-in
     */
    public function test_making_an_api_post_reuest(): void
    {
        
        $response = $this->postJson('api/worker/clock-in', [
            'arrival_time' => '2024-05-15 20:38:35',
            'latitude'     => 30.049612,
            'longitude'    => 31.240252,
        ]);

        $response
            ->assertStatus(201);
    }



    /**
     * testing the post request of an employee clock-in
     */
    public function test_making_an_api_get_reuest(): void
    {
        $response = $this->getJson('api/worker/clock-ins?id=2');

        $response
            ->assertStatus(200);
    }
}
