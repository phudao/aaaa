<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Đào Việt Phú','email' => 'daovietphu@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Nguyễn Duy Phú','email' => 'duyphu82@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Nguyễn Khánh Thượng','email' => 'khanhthuongkansaipaint@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Khúc Ngọc Mai','email' => 'maiknm87@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Nguyễn Thị Yến','email' => 'yennt02@wru.vn','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Nguyễn Minh Thiệp','email' => 'mooncrjesk@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Bùi Việt Phương','email' => 'vietphuong.qlb@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Đỗ Yến Nhung','email' => 'yennhung220391@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Nguyễn Thanh Hải','email' => 'hai.nt9191@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Nguyễn Thị Xuân Hường','email' => 'xuanhuongcntt@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Nguyễn Thị Nguyệt','email' => 'fullmoon2384@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Dương Ngọc Đức','email' => 'duc.dng9@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        //12
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Nguyễn Phú Mỹ','email' => 'nguyenphumy1974@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Đoàn Duy Hùng','email' => 'hungtvtk2@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Đặng Việt Dũng','email' => 'vietdungnorats@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Nguyễn Hà Hưng','email' => 'hahungit@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Mai Trung Kiên','email' => 'maikienqlbmb@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        //5
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Nguyễn Duy Dũng','email' => 'nduydung75@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Nguyễn Văn Giang','email' => 'nguyenvangiang1109@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Công Duy Đức','email' => 'jupiter19872001@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Nguyễn Thanh Hà','email' => 'duatum@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Ngô Nguyệt Thu','email' => 'nnthuvatm@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Lê Hồng Phong','email' => 'dao1viet111ph6u@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Trần Lâm Tùng','email' => 'daovie1t11ph6u@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Đinh Văn Chiến','email' => 'daovi111etph6u@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Nguyễn Ngọc Thắng','email' => 'dao1vi11etph6u@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Nguyễn Văn Tân','email' => 'daovie1tp11h6u@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        //10
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Lương Thanh Tùng','email' => 'tunglt.vatm@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Trịnh Trọng Hiếu','email' => 'tronghieuvn@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Nguyễn Thiên Vân','email' => 'thienvan831@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Đặng Ngọc Quang','email' => 'dangquang83@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Phùng Thanh Bình','email' => 'ptbbka@gmail.com','password' => bcrypt('123456'), 'active' => 1]);
        DB::table('users')->insert(['group_id' => 1, 'name' => 'Vũ Thị Ngọc Trang','email' => 'trangvtn22@gmail.com','password' => bcrypt('123456'), 'active' => 1]);

    }
}
