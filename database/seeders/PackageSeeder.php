<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packagesName = ['إعلان مجانى' => 'Free', 'إعلان VIP' => 'VIP','إعلان مميز' => 'Special','مسوق عقارى' => 'real estate marketer','مطور عقارى' => 'real estate developer',
                         'شركة عقارية' => 'Real estate company'];

        foreach ($packagesName as $key => $package) {
            \DB::table('packages')->insert([
                  'name'   => json_encode([
                          'ar' => $key,
                          'en' => $package
                      ]),
                  'period'   => json_encode([
                                  'ar' => '30 يوم',
                                  'en' => '30 days'
                              ]),
                  'position'   => json_encode([
                                  'ar' => 'اخر الصفحة الاعلانية',
                                  'en' => 'last ad page'
                              ]),
                  'views_number'   => json_encode([
                                                  'ar' => 'لا يزيد عن 1000 مشاهدة',
                                                  'en' => 'No more than 1000 views'
                                              ]),
                  'price' => 150
                              ]);
        }
    }
}
