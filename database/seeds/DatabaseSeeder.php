<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
             $this->call(RolesTableSeeder::class);
             $this->call(UsersTableSeeder::class);

            $this->call(BrandTableSeeder::class);
            $this->call(CategoryPostTableSeeder::class);
            $this->call(CategoryTableSeeder::class);
            $this->call(CouponTableSeeder::class);
            $this->call(CustomerTableSeeder::class);
    }
}
