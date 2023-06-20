<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('prices')->delete();

        \DB::table('prices')->insert(array (
                                        0 =>
                                            array (
                                                'id' => 1,
                                                'region_id' => 1,
                                                'aqar_type_id' => 1,
                                                'price' => 4500,
                                                'created_at' => '2022-01-03 11:03:01',
                                                'updated_at' => '2022-01-03 11:03:01',
                                            ),
                                        1 =>
                                            array (
                                                'id' => 2,
                                                'region_id' => 1,
                                                'aqar_type_id' => 2,
                                                'price' => 6500,
                                                'created_at' => '2022-01-03 11:03:01',
                                                'updated_at' => '2022-01-03 11:03:01',
                                            ),
                                        2 =>
                                            array (
                                                'id' => 3,
                                                'region_id' => 1,
                                                'aqar_type_id' => 3,
                                                'price' => 7500,
                                                'created_at' => '2022-01-03 11:03:01',
                                                'updated_at' => '2022-01-03 11:03:01',
                                            ),
                                        3=>
                                            array (
                                                'id' => 4,
                                                'region_id' => 1,
                                                'aqar_type_id' => 4,
                                                'price' => 8500,
                                                'created_at' => '2022-01-03 11:03:01',
                                                'updated_at' => '2022-01-03 11:03:01',
                                            ),
                                    ));
    }
}
