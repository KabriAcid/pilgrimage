<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RoomSeeder extends Seeder
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
            
          
            DB::table('rooms')->insert([
                'roomId' => $roomNo.$i,
                'propertyId' => 'PP1',
                'floorNumber' => 1,
                'isFull' => 'No',
            ]);
            

        }
        
      
    }
}
