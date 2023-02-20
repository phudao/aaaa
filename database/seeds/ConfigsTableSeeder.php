<?php

use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert(['key'=>1, 'color'=>'green', 'title'=>'Xanh lá', 'group'=>'color']);
        DB::table('configs')->insert(['key'=>2, 'color'=>'red', 'title'=>'Đỏ','group'=>'color']);
        DB::table('configs')->insert(['key'=>3, 'color'=>'orange', 'title'=>'Cam', 'group'=>'color']);
        DB::table('configs')->insert(['key'=>4, 'color'=>'purple', 'title'=>'Tím', 'group'=>'color']);
        DB::table('configs')->insert(['key'=>5, 'color'=>'cyan', 'title'=>'Cyan', 'group'=>'color']);
        DB::table('configs')->insert(['key'=>6, 'color'=>'#d9d9d9', 'title'=>'Trắng', 'group'=>'color']);
        DB::table('configs')->insert(['key'=>1, 'color'=>'green', 'title'=>'ON', 'group'=>'onoff']);
        DB::table('configs')->insert(['key'=>2, 'color'=>'red', 'title'=>'OFF', 'group'=>'onoff']);
        DB::table('configs')->insert(['key'=>1, 'color'=>'green', 'title'=>'Có', 'group'=>'bool']);
        DB::table('configs')->insert(['key'=>2, 'color'=>'red', 'title'=>'Không', 'group'=>'bool']);
        DB::table('configs')->insert(['key'=>1, 'color'=>'green', 'title'=>'Running', 'group'=>'runstop']);
        DB::table('configs')->insert(['key'=>2, 'color'=>'red', 'title'=>'Stoped', 'group'=>'runstop']);
        DB::table('configs')->insert(['key'=>1, 'color'=>'green', 'title'=>'Tốt', 'group'=>'good']);
        DB::table('configs')->insert(['key'=>2, 'color'=>'red', 'title'=>'Không tốt', 'group'=>'good']);
        DB::table('configs')->insert(['key'=>1, 'color'=>'green', 'title'=>'Không có', 'group'=>'adman']);
        DB::table('configs')->insert(['key'=>2, 'color'=>'red', 'title'=>'MET', 'group'=>'adman']);
        DB::table('configs')->insert(['key'=>2, 'color'=>'red', 'title'=>'FPL', 'group'=>'adman']);
        DB::table('configs')->insert(['key'=>3, 'color'=>'red', 'title'=>'TRACK', 'group'=>'adman']);
        DB::table('configs')->insert(['key'=>4, 'color'=>'red', 'title'=>'FPL và TRACK', 'group'=>'adman']);
        DB::table('configs')->insert(['key'=>1, 'color'=>'green', 'title'=>'Đã', 'group'=>'done']);
        DB::table('configs')->insert(['key'=>2, 'color'=>'red', 'title'=>'Chưa', 'group'=>'done']);
    }
}
