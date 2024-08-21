<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    protected $settingsData =
        [
            [
                'terms_of_use' => 'don\'t copy our content',
                'about_us' => 'a group of Egyptian Youth',
                'why_us' => 'to enhance your career',
                'contact_us' => '01234567890',
                'added_colum_1' => 'this is an added colum 1',
                'added_colum_2' => 'this is an added colum 2',
            ],
            [
                'terms_of_use' => 'updated terms of use',
                'about_us' => 'a group of Egyptian men',
                'why_us' => 'enhancing your career',
                'contact_us' => 'no contact is available',
                'added_colum_1' => 'added colum 1',
                'added_colum_2' => 'added colum 2',
            ],
        ];

    public function run(): void
    {
        foreach ($this->settingsData as $data) {
            DB::table('settings')->insert($data);
        }
    }
}
