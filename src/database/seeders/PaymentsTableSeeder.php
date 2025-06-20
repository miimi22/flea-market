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
                'content' => 'カード支払い',
                'user_id' => '2',
                'item_id' => '1',
                'sending_code' => '111-2222',
                'sending_address' => '東京都渋谷区千駄ヶ谷1-1-1',
            ],
            [
                'content' => 'カード支払い',
                'user_id' => '2',
                'item_id' => '2',
                'sending_code' => '111-2222',
                'sending_address' => '東京都渋谷区千駄ヶ谷1-1-1',
            ],
            [
                'content' => 'カード支払い',
                'user_id' => '2',
                'item_id' => '3',
                'sending_code' => '111-2222',
                'sending_address' => '東京都渋谷区千駄ヶ谷1-1-1',
            ],
        ]);
    }
}
