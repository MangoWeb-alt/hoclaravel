<?php

use Illuminate\Database\Seeder;
use App\Brand;
class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::truncate();
        Brand::create([
            'brand_name'=> 'Dell',
            'brand_description'=>'Dell',
            'meta_keywords'=>'Dell',
            'brand_status'=>'2'
        ]);
    }
}
