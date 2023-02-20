<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['name'=>'Tạo nhật kí', 'link'=>'']);
        DB::table('roles')->insert(['name'=>'Sửa nhật kí', 'link'=>'']);
        DB::table('roles')->insert(['name'=>'Xem danh sách nhật kí', 'link'=>'']);
        DB::table('roles')->insert(['name'=>'Xem danh sách chi tiết nhật kí', 'link'=>'']);
        DB::table('roles')->insert(['name'=>'Xem danh sách chi tiết nhật kí', 'link'=>'']);
        DB::table('roles')->insert(['name'=>'Đổi mật khẩu', 'link'=>'']);
        DB::table('roles')->insert(['name'=>'Xem danh sách người dùng', 'link'=>'']);
    }
}
