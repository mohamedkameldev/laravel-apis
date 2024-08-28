<?php

namespace Database\Seeders;

use App\Models\Ad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdSeeder extends Seeder
{
    protected $ads = [
        [
            'title' => 'First Ad',
            'description' => 'this is the description for the first ad',
            'phone' => '01023456789',
            'status' => 'active'
        ],
        [
            'title' => 'Second Ad',
            'description' => 'this is the description for the second ad',
            'phone' => '01000000000',
            'status' => 'active'
        ],
        [
            'title' => 'Third Ad',
            'description' => 'this is the description for the third ad',
            'phone' => '01111111111',
            'status' => 'disabled'
        ],
        [
            'title' => 'Fourth Ad',
            'description' => 'this is the description for the fourth ad',
            'phone' => '01222222222',
            'status' => 'active'
        ],
        [
            'title' => 'Fifth Ad',
            'description' => 'this is the description for the fifth ad',
            'phone' => '0133333333',
            'status' => 'disabled'
        ],
    ];

    public function run(): void
    {
        foreach ($this->ads as $ad) {
            Ad::create($ad);
        }
    }
}
