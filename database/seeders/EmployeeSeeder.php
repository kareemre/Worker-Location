<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('employees')->insert([
                'arrival_time' => fake()->dateTimeBetween('-8 hours', 'now'),
                'latitude'     => 30.049565,
                'longitude'    => 31.240296,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
