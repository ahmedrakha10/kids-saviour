<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aqarTypes = ['عادية' => 'normal', 'مميز جدا' => 'vip','مميز' => 'special'];

        foreach ($aqarTypes as $key => $aqarType) {
            \DB::table('ads_types')->insert([
                'name'   => json_encode([
                     'ar' => $key,
                     'en' => $aqarType
             ]),
        ]);
        }
    }
}
