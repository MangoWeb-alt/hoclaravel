<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();

        Product::create([
                'category_id'=>'1',
                'brand_id'=>'1',
                'product_name'=>'Iphone',
                'product_price'=>'10000000',
                'product_image'=>'download4990.png',
                'product_quantity'=>'100',
                'product_sold'=>'0',
                'meta_product_keywords'=>'Iphone',
                'product_description'=>'Iphone',
                'product_content'=>'Iphone',
                'product_status'=>'2'
            ]);
    }
}
