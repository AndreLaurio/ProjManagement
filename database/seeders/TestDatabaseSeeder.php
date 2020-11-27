<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TestUsersTableSeeder::class);
        $this->call(TestUserPhoneNumbersTableSeeder::class);
        $this->call(TestUserLogsTableSeeder::class);
        $this->call(TestRoomsTableSeeder::class);
        $this->call(TestExamsTableSeeder::class);
        $this->call(TestRoomExamineesTableSeeder::class);        
        $this->call(TestRoomExamsTableSeeder::class);
    }
}
