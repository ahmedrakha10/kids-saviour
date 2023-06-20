<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AqarAdditionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aqarAdditions = ['موقف سيارات' => 'parking', 'عداد مياه' => 'water meter','غاز طبيعى' => 'natural gas','عداد كهرباء'=>'electric meter',
                         'تليفون أرضى'=>'land line', 'أمن'=>'security','أسانسير'=>'elevator','حمام سباحة'=>'Swimming pool'];

        foreach ($aqarAdditions as $key => $aqarAddition) {
            \DB::table('aqar_additions')->insert([
                'name'   => json_encode([
                     'ar' => $key,
                     'en' => $aqarAddition
             ]),
        ]);
        }
    }
}
