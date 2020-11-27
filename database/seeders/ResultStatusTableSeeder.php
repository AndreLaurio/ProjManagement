<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ResultStatusTableSeeder extends Seeder
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
                'result_status_code' => 'P',
                'result_status' => 'PASSED'
            ],
            [
                'result_status_code' => 'F',
                'result_status' => 'FAILED'
            ]
        ];

        DB::table('result_status')->insert($data);
    }
}
