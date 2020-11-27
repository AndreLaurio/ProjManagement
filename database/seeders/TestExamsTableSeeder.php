<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker;
use DB;

class TestExamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($eid = 6; $eid <= 20; $eid++) {

            $faker = Faker\Factory::create();

            for($i = 0; $i < 2; $i++) {

                DB::table('exams')->insert([
                    'examiner_id' => $eid,
                    'exam_code' => $faker->regexify('[a-zA-Z0-9]{10}'),
                    'exam_title' => $faker->sentence($faker->numberBetween(3, 6)),
                    'exam_desc' => $faker->paragraph($faker->numberBetween(0, 4)),
                    'passing_percentage' => 75.00
                ]);
            }
        }
    }
}
