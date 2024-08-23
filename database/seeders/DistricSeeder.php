<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistricSeeder extends Seeder
{
    protected $districts = [
        ["name" => "Nasr City", "city_id" => 1],
        ["name" => "Heliopolis", "city_id" => 1],
        ["name" => "Zamalek", "city_id" => 1],
        ["name" => "Maadi", "city_id" => 1],
        ["name" => "Al-Montaza", "city_id" => 2],
        ["name" => "Smouha", "city_id" => 2],
        ["name" => "Sidi Gaber", "city_id" => 2],
        ["name" => "Mohandessin", "city_id" => 3],
        ["name" => "Dokki", "city_id" => 3],
        ["name" => "6th of October", "city_id" => 3],
        ["name" => "Shubra", "city_id" => 4],
        ["name" => "Warraq", "city_id" => 4],
        ["name" => "Al-Manakh", "city_id" => 5],
        ["name" => "Arab", "city_id" => 5],
        ["name" => "Arbaeen", "city_id" => 6],
        ["name" => "Ataka", "city_id" => 6],
        ["name" => "Karnak", "city_id" => 7],
        ["name" => "Armant", "city_id" => 7],
        ["name" => "Al-Badari", "city_id" => 8],
        ["name" => "Manfalut", "city_id" => 8],
        ["name" => "Qantara", "city_id" => 9],
        ["name" => "Abu Suwir", "city_id" => 9],
        ["name" => "Ibsheway", "city_id" => 10],
        ["name" => "Tamya", "city_id" => 10],
        ["name" => "Sinnuris", "city_id" => 10],
    ];


    public function run(): void
    {
        foreach ($this->districts as $district) {
            DB::table('districts')->insert($district);
        }
    }
}
