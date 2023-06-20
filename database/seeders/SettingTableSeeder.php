<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
             $desc_ar = 'عقار بيست موقع الكترونى للاعلانات لا يملك العقارات المعروضة على الموقع ولا يسوق لها لهذا فى حال  رغبتك فى الاستفسار عن عقار معين يرجى التواصل مباشرة مع المعلن من داخل صفحة  اعلان العقار اذا كان اى استفسار او سؤال اخر او لديك اى مشكلة  راسلنا من خلال';
             $desc_en  = 'Aqar Best is a website for advertisements that does not own the properties displayed on the site and does not market to them. For this reason, if you wish to inquire about a specific property, please contact the advertiser directly from within the property advertisement page. If there is any inquiry or other question or you have any problem, contact us through';

             \DB::table('settings')->insert([
                'title'   => 'test',
                'email'   => 'info@aqarbest.com',
                'facebook'   => 'https://www.facebook.com',
                'twitter'   => 'https://twitter.com',
                'instagram'   => 'https://www.instagram.com',
                'linkedin'   => 'https://www.linkedin.com',
                'youtube'   => ' https://www.youtube.com/c/AqarBest',
                'tiktok'   => 'https://www.tiktok.com/@aqarbest?traffic_type=google&referer_url=amp_aqarbest&referer_video_id=7012354388622576902',
                'description'   => json_encode([
                                            'ar' => $desc_ar,
                                            'en' => $desc_en
                                        ]),
        ]);
        $count =1;
           for ($i=1;$i<=6;$i++){
               \DB::table('images')->insert([
                                                  'url'   => 'aqar'.$count++ . '.png',
                                                  'type'   => ($i <= 2) ? 'vip' : (($i > 2 && $i<= 4) ? 'special' : 'normals'),
                                                  'imageable_id'   => '1',
                                                  'imageable_type'   => 'App\Models\Setting',
                                              ]);
           }


    }
}
