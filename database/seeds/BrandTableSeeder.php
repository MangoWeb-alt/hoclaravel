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

        $brandData = $this->getBrandData();

        foreach($brandData as $data){
            Brand::create($data);
        }
    }
    private function getBrandData(){
        return [
            [
                "brand_name" => "Dell",
                "brand_description" =>"Dell",
                "meta_keywords" => "Dell",
                "brand_status" => "Dell",
            ],
        ];
    }




}
