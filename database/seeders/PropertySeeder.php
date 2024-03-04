<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('properties')->insert([
            'propertyId' => 'PP1',
            'name' => 'Full name of the property',
            'location' => 'its location',
            'distance' => '1 km from Haram',
            'numberOfFloor' => 11,
            'totalRooms' => 80,
            'totalBedSpaces' => 800,
            'address' => 'address',
            'hajjYear' => '2023',
        ]);
        DB::table('properties')->insert([
            'propertyId' => 'PP2',
            'name' => 'Full name of the property',
            'location' => 'its location',
            'distance' => '2 km from Haram',
            'numberOfFloor' => 12,
            'totalRooms' => 100,
            'totalBedSpaces' => 1200,
            'address' => 'address',
            'hajjYear' => '2023',
        ]);
        DB::table('properties')->insert([
            'propertyId' => 'PP3',
            'name' => 'Full name of the property',
            'location' => 'its location',
            'distance' => '3 km from Haram',
            'numberOfFloor' => 8,
            'totalRooms' => 70,
            'totalBedSpaces' => 700,
            'address' => 'address',
            'hajjYear' => '2023',
        ]);
    }
}
