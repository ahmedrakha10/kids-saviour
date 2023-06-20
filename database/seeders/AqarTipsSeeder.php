<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AqarTipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aqarTips = ['نصائح واخبار عقارية' =>'Real estate tips and news' , 'مشاريع جديدة' => 'New projects','معارض' =>
            'exhibition','اعرف اكثر عن مدينتك'=>'Know more about your city','ديكور بيتك'=>'Your home decor','اماكن خروج وترفيه'
        =>'Outings and entertainment'];

        foreach ($aqarTips as $key => $aqarTip) {
            \DB::table('aqar_tips')->insert([
                 'name'   => json_encode([
                         'ar' => $key,
                         'en' => $aqarTip
                                         ]),
                                             ]);
        }
    }
}
