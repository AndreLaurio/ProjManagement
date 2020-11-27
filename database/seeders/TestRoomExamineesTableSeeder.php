<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker;
use DB;

class TestRoomExamineesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($rid = 1; $rid <= 15; $rid++) {
            
            $faker = Faker\Factory::create();

            for($i = 0; $i < 10; $i++) {

                DB::table('room_examinees')->insert([
                    'room_id' => $rid,
                    'examinee_id' => $faker->unique()->numberBetween(21, 50)
                ]);
            }
        }
    }
}
