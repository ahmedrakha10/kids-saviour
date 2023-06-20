<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = ['الاميرية' => 'ameria', 'ابوالريش' => 'abo elreesh','سموحه' => 'soumoha'];

        foreach ($regions as $key => $region) {
            \DB::table('regions')->insert([
                'name'   => json_encode([
                     'ar' => $key,
                     'en' => $region
             ]),
                'city_id' => rand(1,3)
        ]);
        }
    }
}
