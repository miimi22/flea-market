<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            [
                'content' => 'コンビニ払い',
                'user_id' => '1',
                'item_id' => '1',
            ],
            [
                'content' => 'カード支払い',
                'user_id' => '1',
                'item_id' => '1',
            ],
        ]);
    }
}
