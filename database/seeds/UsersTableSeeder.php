<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Roles;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        DB::table('admin_roles')->truncate();

        $adminRoles = Roles::where('name','admin')->first();
        $authorRoles = Roles::where('name','author')->first();
        $userRoles = Roles::where('name','user')->first();

        $admin = Admin::create([
           'admin_name' => 'HieuAdmin',
           'admin_email' => 'deagleka1@gmail.com',
            'admin_password'=> md5('123456')
        ]);
        $author = Admin::create([
            'admin_name' => 'HieuAuthor',
            'admin_email' => 'deagleka2@gmail.com',
            'admin_password'=> md5('123456'),
        ]);
        $user = Admin::create([
            'admin_name' => 'HieuUser',
            'admin_email' => 'deagleka3@gmail.com',
            'admin_password'=> md5('123456'),
        ]);
        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);

    }
}
