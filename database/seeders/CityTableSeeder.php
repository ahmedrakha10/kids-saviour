<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = ['القاهرة' => 'cairo', 'الجيزة' => 'giza','الاسكندريه' => 'alexandria'];

        foreach ($cities as $key => $city) {
            \DB::table('cities')->insert([
                'name'   => json_encode([
                     'ar' => $key,
                     'en' => $city
             ]),
        ]);
        }
    }
}
