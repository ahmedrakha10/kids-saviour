<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
//        $this->call(AdsTypeTableSeeder::class);
//        $this->call(PaymentMethodTableSeeder::class);
//        $this->call(AqarKindTableSeeder::class);
//        $this->call(AqarTypeTableSeeder::class);
//        $this->call(AqarCategoryTableSeeder::class);
//        $this->call(AqarAdditionTableSeeder::class);
//        $this->call(CityTableSeeder::class);
//        $this->call(RegionTableSeeder::class);
//        $this->call(SettingTableSeeder::class);
//        $this->call(ServiceTableSeeder::class);
//        $this->call(AqarTableSeeder::class);
//        $this->call(UsersTableSeeder::class);
//        $this->call(FinishingTypeSeeder::class);
        // $this->call(AqarTipsSeeder::class);
        //$this->call(PriceTableSeeder::class);
        //$this->call(PackageSeeder::class);
        $this->call(LaratrustSeeder::class);
    }
}
