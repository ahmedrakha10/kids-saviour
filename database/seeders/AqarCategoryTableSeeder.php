<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AqarCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aqarCategories = ['شقة' => 'flat', 'ستوديو' => 'studio','دوبلكس' => 'duplex','بنتهاوس'=>'penthouse','شقة بروف'=>'Prof apartment',
                           'توين هاوس'=>'twin house',
                      'تاون هاوس'=>'Townhouse','فيلا منفصلة'=>'detached villa','قصر'=>'Castle','شالية أرضي'=>'ground chalet','شالية علوى'=>'upper chalet',
                           'أرض سكنية'=>'residential land','أرض تجارية'=>'commercial land','أرض زراعية'=>'Agricultural Land',
                           'أرض صناعية'=>'industrial land','منزل بيت'=>'house','عمارة'=>'construction',
                           'مصنع'=>'company','محلات'=>'Shops','مطعم'=>'Restaurant','كافية'=>'cafe','حضانة أطفال'=>'baby daycare','مدرسة'=>'School',
                           'مستودع'=>'storehouse','مول'=>'mall','فندق'=>'Hotel','جراج'=>'garage','مكاتب'=>'offices',
                           'غرفة فى مكتب'=>'room in office','مقر إدارى'=>'administrative headquarters','عيادات'=>'clinics','صيدليات'=>'pharmacies',
                           'معمل طبي'=>'medical lab','مستشفى'=>'hospital','غرفة فى عيادة'=>'room in clinic','مصنع تحت الإنشاء'=>'Factory under construction'];

        foreach ($aqarCategories as $key => $aqarCategory) {
            \DB::table('aqar_categories')->insert([
                'name'   => json_encode([
                     'ar' => $key,
                     'en' => $aqarCategory
             ]),
                'aqar_type_id'  => rand(1,8)
        ]);
        }
    }
}
