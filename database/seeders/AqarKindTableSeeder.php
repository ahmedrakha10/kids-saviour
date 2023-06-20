<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AqarKindTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentMethods = ['للبيع' => 'for rent', 'إيجار' => 'for sale',
                           'مشاريع' => 'projects','شركات'=>'companies'];

        foreach ($paymentMethods as $key => $paymentMethod) {
            \DB::table('aqar_kinds')->insert([
                'name'   => json_encode([
                     'ar' => $key,
                     'en' => $paymentMethod
             ]),
        ]);
        }
    }
}
