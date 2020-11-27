<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class LogTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'log_type_id' => 1,
                'log_type' => 'LOG IN'
            ],
            [
                'log_type_id' => 2,
                'log_type' => 'LOG OUT'
            ]
        ];

        DB::table('log_types')->insert($data);
    }
}
