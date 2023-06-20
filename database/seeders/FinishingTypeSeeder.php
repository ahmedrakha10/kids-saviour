<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FinishingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $finishTypings = ['بدون تشطيب' => 'without finishing', 'نص تشطيب' => 'half finishing','لوكس' => 'lux','سوبر لوكس'=>'Super Lux',
                          'اكسترا سوبر لوكس'=>'Extra Super Lux'];

        foreach ($finishTypings as $key => $finishingType) {
            \DB::table('finishing_types')->insert([
                 'name'   => json_encode([
                                             'ar' => $key,
                                             'en' => $finishingType
                                         ]),
                                             ]);
        }
    }
}
