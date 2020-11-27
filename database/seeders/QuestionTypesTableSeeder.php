<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class QuestionTypesTableSeeder extends Seeder
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
                'question_type_id' => 1,
                'question_type' => 'SINGLE-SELECT MULTIPLE CHOICE'
            ],
            [
                'question_type_id' => 2,
                'question_type' => 'MULTI-SELECT MULTIPLE CHOICE'
            ],
            [
                'question_type_id' => 3,
                'question_type' => 'TRUE OR FALSE'
            ],
            [
                'question_type_id' => 4,
                'question_type' => 'FREE-TEXT'
            ],
            [
                'question_type_id' => 5,
                'question_type' => 'ENUMERATION'
            ]
        ];

        DB::table('question_types')->insert($data);
    }
}
