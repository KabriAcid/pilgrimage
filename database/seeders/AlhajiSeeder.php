<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlhajiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alhajis')->insert([

            'alhajiId' => 'kat001',
            'fullName' => 'Abu16',
            'lga' => 'Katsina',
            'gender' => 'male',
            'town' => 'Katsina',
            'hajjYear' => '2023',
            'airLifted' => 'No',
            'accomodated' => 'No',
            'isOfficial' => 'No',

        ]);
        DB::table('alhajis')->insert([

            'alhajiId' => 'kat002',
            'fullName' => 'Arma',
            'lga' => 'kankara',
            'town' => 'zango',
            'gender' => 'male',
            'hajjYear' => '2023',
            'airLifted' => 'No',
            'accomodated' => 'No',
            'isOfficial' => 'No',

        ]);
    }
}
