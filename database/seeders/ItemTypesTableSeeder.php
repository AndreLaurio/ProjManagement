<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ItemTypesTableSeeder extends Seeder
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
                'item_type_id' => 1,
                'item_type' => 'QUESTION'
            ],
            [
                'item_type_id' => 2,
                'item_type' => 'TEXT'
            ]
        ];

        DB::table('item_types')->insert($data);
    }
}
