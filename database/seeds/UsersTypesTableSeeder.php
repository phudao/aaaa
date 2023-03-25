<?php

use Illuminate\Database\Seeder;

class UsersTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_types')->insert(['user_id'=>1, 'type_id'=>1]);
        DB::table('users_types')->insert(['user_id'=>2, 'type_id'=>1]);
        DB::table('users_types')->insert(['user_id'=>3, 'type_id'=>1]);
        DB::table('users_types')->insert(['user_id'=>4, 'type_id'=>1]);
        DB::table('users_types')->insert(['user_id'=>5, 'type_id'=>1]);
        DB::table('users_types')->insert(['user_id'=>6, 'type_id'=>1]);
        DB::table('users_types')->insert(['user_id'=>7, 'type_id'=>1]);
        DB::table('users_types')->insert(['user_id'=>8, 'type_id'=>1]);
        DB::table('users_types')->insert(['user_id'=>9, 'type_id'=>1]);
        DB::table('users_types')->insert(['user_id'=>10, 'type_id'=>1]);
        DB::table('users_types')->insert(['user_id'=>11, 'type_id'=>1]);
        DB::table('users_types')->insert(['user_id'=>12, 'type_id'=>1]);

        DB::table('users_types')->insert(['user_id'=>13, 'type_id'=>1]);
        DB::table('users_types')->insert(['user_id'=>14, 'type_id'=>1]);
        DB::table('users_types')->insert(['user_id'=>15, 'type_id'=>1]);
        DB::table('users_types')->insert(['user_id'=>16, 'type_id'=>1]);
        DB::table('users_types')->insert(['user_id'=>17, 'type_id'=>1]);

        DB::table('users_types')->insert(['user_id'=>13, 'type_id'=>2]);
        DB::table('users_types')->insert(['user_id'=>14, 'type_id'=>2]);
        DB::table('users_types')->insert(['user_id'=>15, 'type_id'=>2]);
        DB::table('users_types')->insert(['user_id'=>16, 'type_id'=>2]);
        DB::table('users_types')->insert(['user_id'=>17, 'type_id'=>2]);

        DB::table('users_types')->insert(['user_id'=>18, 'type_id'=>3]);
        DB::table('users_types')->insert(['user_id'=>19, 'type_id'=>3]);
        DB::table('users_types')->insert(['user_id'=>20, 'type_id'=>3]);
        DB::table('users_types')->insert(['user_id'=>21, 'type_id'=>3]);
        DB::table('users_types')->insert(['user_id'=>22, 'type_id'=>3]);
        DB::table('users_types')->insert(['user_id'=>23, 'type_id'=>3]);
        DB::table('users_types')->insert(['user_id'=>24, 'type_id'=>3]);
        DB::table('users_types')->insert(['user_id'=>25, 'type_id'=>3]);
        DB::table('users_types')->insert(['user_id'=>26, 'type_id'=>3]);
        DB::table('users_types')->insert(['user_id'=>27, 'type_id'=>3]);

        DB::table('users_types')->insert(['user_id'=>28, 'type_id'=>1]);
        DB::table('users_types')->insert(['user_id'=>29, 'type_id'=>1]);
        DB::table('users_types')->insert(['user_id'=>30, 'type_id'=>1]);
        DB::table('users_types')->insert(['user_id'=>31, 'type_id'=>1]);
    }
}
