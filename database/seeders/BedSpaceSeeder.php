<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BedSpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i =1; $i<=50; $i++){
            $roomNo = '10';
            if ($i >= 10){
                $roomNo = '1';
                
            }

            for ($j =1; $j<=8; $j++){
                DB::table('bed_spaces')->insert([
                    'spaceId' => '00'.$j,   
                    'roomId' =>$roomNo.$i,
                    'isAllocated' =>'no',
                    'propertyId' =>'PP1',
        
        
                ]);
            }


        }
        
    }
}
