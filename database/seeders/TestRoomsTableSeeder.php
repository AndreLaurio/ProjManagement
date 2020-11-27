<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker;
use DB;

class TestRoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($eid = 6; $eid <= 20; $eid++) {

            DB::table('rooms')->insert([
                'examiner_id' => $eid,
                'room_code' => $faker->regexify('[a-zA-Z0-9]{8}'),
                'room_title' => $faker->sentence($faker->numberBetween(3, 6)),
                'room_desc' => $faker->paragraph($faker->numberBetween(0, 4))
            ]);
        }
    }
}
