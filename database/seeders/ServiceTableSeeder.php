<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = ['الحاسبة العقارية' => 'real estate calculator', 'خدمات قانونية' => 'legal services','قيم عقارك الان' => 'Rate your property now',
                     'تصوير'=>'photography','نقل اثاث' => 'Moving furniture','تصميم وديكور' => 'design and decor','وكيلك العقارى' => 'Your real estate agent'];

        foreach ($services as $key => $service) {
            \DB::table('services')->insert([
                'name'   => json_encode([
                     'ar' => $key,
                     'en' => $service
             ]),
                'description'   => json_encode([
                    'ar' => 'تيست تيست',
                    'en' => 'test test test'
                ]),
        ]);
        }
    }
}
