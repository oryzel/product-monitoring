<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_photos')->insert([
            'product_id' => 1,
            'photo_url' => 'https://m2fabelio.imgix.net/catalog/product/cache/small_image/300x300/beff4985b56e3afdbeabfc89641a4582/k/u/Kubos_2020_Frame_0.jpg',
            'is_deleted' => false
        ]);
        DB::table('product_photos')->insert([
            'product_id' => 1,
            'photo_url' => 'https://m2fabelio.imgix.net/catalog/product/cache/small_image/300x300/beff4985b56e3afdbeabfc89641a4582/k/u/Kubos_Door_1.jpg',
            'is_deleted' => false,
        ]);
        DB::table('product_photos')->insert([
            'product_id' => 1,
            'photo_url' => 'https://m2fabelio.imgix.net/catalog/product/cache/small_image/300x300/beff4985b56e3afdbeabfc89641a4582/r/a/Raisa_Dresser_Set_with_Cabinet_-_Kit_0.jpg',
            'is_deleted' => false,
        ]);
    }
}
