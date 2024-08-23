<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            [ 'id' => 1 , 'name' => "Cairo" ],
            [ 'id' => 2 , 'name' => "Alexandria" ],
            [ 'id' => 3 , 'name' => "Giza" ],
            [ 'id' => 4 , 'name' => "Shubra El Kheima" ],
            [ 'id' => 5 , 'name' => "Port Said" ],
            [ 'id' => 6 , 'name' => "Suez" ],
            [ 'id' => 7 , 'name' => "Luxor" ],
            [ 'id' => 8 , 'name' => "Asyut" ],
            [ 'id' => 9 , 'name' => "Ismailia" ],
            [ 'id' => 10, 'name' => "Faiyum" ]
        ];

        foreach ($cities as $city) {
            DB::table('cities')->insert($city);
        }
    }
}
