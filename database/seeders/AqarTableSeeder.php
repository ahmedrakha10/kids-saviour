<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AqarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = ['عقار 1' => 'real estate calculator', 'عقار 2' => 'legal services','عقار 3' => 'Rate your property now',
                     'عقار 4'=>'photography','عقار 5' => 'Moving furniture','عقار 6' => 'design and decor','عقار 7' => 'Your real estate agent',
                     'عقار 8' =>'Aqar 8','عقار 9' =>'Aqar 9','عقار 10' =>'Aqar 10','عقار 11' =>'Aqar 11','عقار 12' =>'Aqar 12',
        ];
         $count =1;
         $co =1;
        foreach ($services as $key => $service) {
            \DB::table('aqars')->insert([
                'name'   => json_encode([
                     'ar' => $key,
                     'en' => $service
             ]),
                'description'   => json_encode([
                    'ar' => 'تيست تيست',
                    'en' => 'test test test'
                ]),
                'ads_type_id' => rand(1,3),
                'aqar_category_id' => rand(1,36),
                'payment_method_id' => rand(1,4),
                'region_id' => rand(1,3),
                'width' => rand(100,1000),
                'price' => rand(200000,3000000),
                'registered' => 'yes',
                'phone' => '01004569693',
                'lat' => '12.235',
                'lng' => '12.235',
                'code' => 'Aq0'.$count++,
                'image' => 'aqar'.$co++ . '.png',
                'bed_rooms' => rand(1,3),
                'bath_rooms' => rand(1,5),
                'views' => rand(1,1000),
        ]);
        }
    }
}
