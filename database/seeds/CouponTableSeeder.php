<?php

use Illuminate\Database\Seeder;
use App\Coupon;
class CouponTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::truncate();

        Coupon::created([
            'coupon_name'=>'Discount 30%',
            'coupon_number'=>'30',
            'coupon_code'=>'HDH375Y',
            'coupon_time'=>'30',
            'coupon_condition'=>'1',
        ]);
        Coupon::create([
            'coupon_name'=>'Discount 100000VND',
            'coupon_number'=>'100000',
            'coupon_code'=>'HDH458Y',
            'coupon_time'=>'100',
            'coupon_condition'=>'2',
        ]);
    }
}
