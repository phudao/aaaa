<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert(['name'=>'Nhân viên']);
        DB::table('types')->insert(['name'=>'Kíp trưởng']);
        DB::table('types')->insert(['name'=>'Trực khối']);
    }
}
