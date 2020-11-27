<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Faker;

class TestUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 50; $i++) {

            DB::table('users')->insert([
                'email' => $faker->email,
                'user_type_id' => 3,
                'password' => $faker->password,
                'first_name' => $faker->firstName,
                'middle_name' => $faker->lastName,
                'last_name' => $faker->lastName,
                'suffix_name' => $faker->suffix,
                'photo_src' => 'default.jpg'
            ]);
        }
        
        DB::unprepared("UPDATE users SET user_type_id = 1 WHERE user_id > 0 AND user_id <= 5");
        DB::unprepared("UPDATE users SET user_type_id = 2 WHERE user_id > 5 AND user_id <= 20");
    }
}
