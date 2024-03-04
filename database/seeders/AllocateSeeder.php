<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllocateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bed_spaces')->where('propertyId', 'PP1')->where('roomId', '101')
            ->where('spaceId', '001')->update([
                'isAllocated' => 'Yes',
                'alhajiID' => 'kat001',

            ]);

        DB::table('bed_spaces')->where('propertyId', 'PP1')->where('roomId', '101')
            ->where('spaceId', '002')->update([
                'isAllocated' => 'Yes',
                'alhajiID' => 'kat001',

            ]);
        DB::table('alhajis')->where('alhajiId', 'kat001')
            ->update([
                'accomodated' => 'yes',

            ]);
        DB::table('bed_spaces')->where('propertyId', 'PP1')->where('roomId', '101')
            ->where('spaceId', '003')->update([
                'isAllocated' => 'Yes',
                'alhajiID' => 'kat002',

            ]);
            DB::table('alhajis')->where('alhajiId', 'kat002')
            ->update([
                'accomodated' => 'yes',

            ]);
    }
}
