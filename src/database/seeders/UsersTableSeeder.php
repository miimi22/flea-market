<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => '山田太郎',
                'email' => 'taro@gmail.com',
                'password' => bcrypt('coachtech1'),
            ],
            [
                'name' => '鈴木花子',
                'email' => 'hanako@gmail.com',
                'password' => bcrypt('coachtech2'),
            ],
            [
                'name' => '田中一郎',
                'email' => 'ichiro@gmail.com',
                'password' => bcrypt('coachtech3'),
            ],
        ]);
    }
}
