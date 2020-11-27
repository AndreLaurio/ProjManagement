<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TestRoomExamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($rid = 1; $rid <= 15; $rid++) {

            for($xid = $rid * 2 - 1; $xid <= $rid * 2; $xid++) {

                DB::table('room_exams')->insert([
                    'room_id' => $rid,
                    'exam_id' => $xid
                ]);
            }
        }
    }
}
