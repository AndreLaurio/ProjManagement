<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker;
use DB;

class TestUserLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 100; $i++) {

            DB::table('user_logs')->insert([
                'user_id' => $faker->numberBetween(1, 50),
                'log_type_id' => $faker->numberBetween(1, 2),
                'logged_at' => $faker->dateTime(),
            ]);
        }
    }
}
