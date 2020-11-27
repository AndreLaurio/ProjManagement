<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CoreDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTypesTableSeeder::class);
        $this->call(PhoneTypesTableSeeder::class);
        $this->call(LogTypesTableSeeder::class);
        $this->call(ItemTypesTableSeeder::class);
        $this->call(QuestionTypesTableSeeder::class);
        $this->call(MCQProbabilitiesTableSeeder::class);
    }
}
