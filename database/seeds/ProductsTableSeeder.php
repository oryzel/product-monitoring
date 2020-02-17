<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Kabinet Leroy Pintu Kaca',
            'description' => 'Sentuhan Gaya Mid Century Pada Kabinet Display',
            'link' => 'https://fabelio.com/ip/leroy-high-sideboards-kit.html',
            'is_deleted' => false,
        ]);
    }
}
