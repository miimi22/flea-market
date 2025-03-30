<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            [
                'product_name' => '腕時計',
                'product_price' => '15000',
                'product_description' => 'スタイリッシュなデザインのメンズ腕時計',
                'product_image' => 'storage/images/Clock.jpg',
                'user_id' => '1',
                'condition_id' => '1',
            ],
            [
                'product_name' => 'HDD',
                'product_price' => '5000',
                'product_description' => '高速で信頼性の高いハードディスク',
                'product_image' => 'storage/images/Hdd.jpg',
                'user_id' => '3',
                'condition_id' => '2',
            ],
            [
                'product_name' => '玉ねぎ3束',
                'product_price' => '300',
                'product_description' => '新鮮な玉ねぎ3束のセット',
                'product_image' => 'storage/images/Onion.jpg',
                'user_id' => '2',
                'condition_id' => '3',
            ],
            [
                'product_name' => '革靴',
                'product_price' => '4000',
                'product_description' => 'クラシックなデザインの革靴',
                'product_image' => 'storage/images/Shoes.jpg',
                'user_id' => '1',
                'condition_id' => '4',
            ],
            [
                'product_name' => 'ノートPC',
                'product_price' => '45000',
                'product_description' => '高性能なノートパソコン',
                'product_image' => 'storage/images/Laptop.jpg',
                'user_id' => '3',
                'condition_id' => '1',
            ],
            [
                'product_name' => 'マイク',
                'product_price' => '8000',
                'product_description' => '高音質のレコーディング用マイク',
                'product_image' => 'storage/images/Mic.jpg',
                'user_id' => '3',
                'condition_id' => '2',
            ],
            [
                'product_name' => 'ショルダーバッグ',
                'product_price' => '3500',
                'product_description' => 'おしゃれなショルダーバッグ',
                'product_image' => 'storage/images/Bag.jpg',
                'user_id' => '2',
                'condition_id' => '3',
            ],
            [
                'product_name' => 'タンブラー',
                'product_price' => '500',
                'product_description' => '使いやすいタンブラー',
                'product_image' => 'storage/images/Tumbler.jpg',
                'user_id' => '1',
                'condition_id' => '4',
            ],
            [
                'product_name' => 'コーヒーミル',
                'product_price' => '4000',
                'product_description' => '手動のコーヒーミル',
                'product_image' => 'storage/images/Coffeemill.jpg',
                'user_id' => '2',
                'condition_id' => '1',
            ],
            [
                'product_name' => 'メイクセット',
                'product_price' => '2500',
                'product_description' => '便利なメイクアップセット',
                'product_image' => 'storage/images/Cosmeticsset.jpg',
                'user_id' => '2',
                'condition_id' => '2',
            ],
        ]);
    }
}
