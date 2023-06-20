<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

             \DB::table('users')->insert([
                'first_name'   => 'test',
                'last_name'   => ' test',
                'email'   => 'test@test.gmail.com',
                'phone'   => '01004591695',
                'password'   => bcrypt('123'),
                'type'   => 'user',
                'image'   => 'uploads/users/default.png',
        ]);

    }
}
