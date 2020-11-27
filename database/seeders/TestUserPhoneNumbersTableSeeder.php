<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker;
use DB;

class TestUserPhoneNumbersTableSeeder extends Seeder
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

            DB::table('user_phone_numbers')->insert([
                'user_id' => $faker->numberBetween(1, 50),
                'phone_type_id' => $faker->numberBetween(1, 2),
                'phone_number' => $faker->phoneNumber,
            ]);
        }
    }
}
