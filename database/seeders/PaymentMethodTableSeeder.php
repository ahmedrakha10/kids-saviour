<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentMethodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentMethods = ['بطاقة الإتمان' => 'Credit card', 'محفظتك على عقار بيست' => 'Your wallet on Aqar Best',
                           'فودافون كاش' => 'Vodafone cash','خصم من رصيد الهاتف'=>'Deduction from phone balance'];

        foreach ($paymentMethods as $key => $paymentMethod) {
            \DB::table('payment_methods')->insert([
                'name'   => json_encode([
                     'ar' => $key,
                     'en' => $paymentMethod
             ]),
        ]);
        }
    }
}
