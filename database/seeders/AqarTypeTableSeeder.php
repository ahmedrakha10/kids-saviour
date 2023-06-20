<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AqarTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aqarTypes = ['شقق' => 'Apartments', 'فلل' => 'villas','شاليهات' => 'chalets','أراضى'=>'lands','مبانى'=>'buildings','تجارى'=>'commercial',
                      'إدارى'=>'Administrative','طبى'=>',medical'];

        foreach ($aqarTypes as $key => $aqarType) {
            \DB::table('aqar_types')->insert([
                'name'   => json_encode([
                     'ar' => $key,
                     'en' => $aqarType
             ]),
        ]);
        }
    }
}
