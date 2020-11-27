<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PhoneTypesTableSeeder extends Seeder
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
                'phone_type_id' => 1,
                'phone_type' => 'CELLPHONE'
            ],
            [
                'phone_type_id' => 2,
                'phone_type' => 'TELEPHONE'
            ]
        ];

        DB::table('phone_types')->insert($data);
    }
}
