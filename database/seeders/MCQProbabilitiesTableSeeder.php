<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class MCQProbabilitiesTableSeeder extends Seeder
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
                'mcq_probability_id' => 1,
                'mcq_probability' => 'AT LEAST'
            ],
            [
                'mcq_probability_id' => 2,
                'mcq_probability' => 'AT MOST'
            ],
            [
                'mcq_probability_id' => 3,
                'mcq_probability' => 'EXACTLY'
            ]
        ];

        DB::table('mcq_probabilities')->insert($data);
    }
}
