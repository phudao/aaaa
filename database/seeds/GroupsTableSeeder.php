<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert(['name'=>'CNTT']);
        DB::table('groups')->insert(['name'=>'MANAGER']);
        DB::table('groups')->insert(['name'=>'ADMIN']);
    }
}
