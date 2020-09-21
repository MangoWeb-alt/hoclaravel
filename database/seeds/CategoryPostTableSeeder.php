<?php

use Illuminate\Database\Seeder;
use App\CategoryPost;
class CategoryPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryPost::create([
            'post_category_name'=> 'Phone',
            'post_category_slug'=> 'Nutrition',
            'post_category_description'=>'GamePad',
            'post_category_meta_keywords'=>'GamePad',
            'post_category_status'=>'2'
        ]);
    }
}
