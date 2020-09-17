<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        Category::create([
            'category_name'=> 'Xbox-360',
            'category_slug'=> 'xbox-360',
            'category_description'=>'xbox-360',
            'meta_keywords'=>'xbox-360',
            'category_parent'=> '0',
            'category_status'=>'2'
        ]);
    }
}
