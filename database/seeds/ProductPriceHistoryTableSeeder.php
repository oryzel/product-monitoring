<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPriceHistoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_price_history')->insert([
            'product_id' => 1,
            'price' => 1500000,
            'is_deleted' => false,
            'created_at' => "2020-02-18 22:00"
        ]);
        DB::table('product_price_history')->insert([
            'product_id' => 1,
            'price' => 1550000,
            'is_deleted' => false,
            'created_at' => "2020-02-18 23:00"
        ]);
        DB::table('product_price_history')->insert([
            'product_id' => 1,
            'price' => 1620000,
            'is_deleted' => false,
            'created_at' => "2020-02-19 00:00"
        ]);
        DB::table('product_price_history')->insert([
            'product_id' => 1,
            'price' => 1620000,
            'is_deleted' => false,
            'created_at' => "2020-02-19 01:00"
        ]);
        DB::table('product_price_history')->insert([
            'product_id' => 1,
            'price' => 1580000,
            'is_deleted' => false,
            'created_at' => "2020-02-19 02:00"
        ]);
        DB::table('product_price_history')->insert([
            'product_id' => 1,
            'price' => 1580000,
            'is_deleted' => false,
            'created_at' => "2020-02-19 03:00"
        ]);
        DB::table('product_price_history')->insert([
            'product_id' => 1,
            'price' => 1880000,
            'is_deleted' => false,
            'created_at' => "2020-02-19 04:00"
        ]);
        DB::table('product_price_history')->insert([
            'product_id' => 1,
            'price' => 1880000,
            'is_deleted' => false,
            'created_at' => "2020-02-19 05:00"
        ]);
        DB::table('product_price_history')->insert([
            'product_id' => 1,
            'price' => 1640000,
            'is_deleted' => false,
            'created_at' => "2020-02-20 01:00"
        ]);
        DB::table('product_price_history')->insert([
            'product_id' => 1,
            'price' => 1720000,
            'is_deleted' => false,
            'created_at' => "2020-02-20 02:00"
        ]);
        DB::table('product_price_history')->insert([
            'product_id' => 1,
            'price' => 1720000,
            'is_deleted' => false,
            'created_at' => "2020-02-20 03:00"
        ]);
    }
}
