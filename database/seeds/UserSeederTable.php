<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class UserSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('admins')->delete();


        DB::table('admins')->insert([
            'name' => 'Adebayo',
            'email' => 'ade@gmail.com',
            'status' => 1,
            'photo' => '1529932498avatar.png',
            'phone' => 7084940333,
            'remember_token' => str_random(10),
            'password' => bcrypt('ade123'),
            'created_at' => Carbon::parse(now())->format('Y.m.d'),
            // 'created_at' => time()
        ]);


        DB::table('admins')->insert([
        'name' => 'Yunus Ayo',
        'email' => 'admin@gmail.com',
        'status' => 1,
        'phone' => 90345678,
        'photo' => '1529932498avatar.png',
        'password' => bcrypt('admin123'),
        'remember_token' => str_random(10),
        'created_at' => Carbon::parse(now())->format('Y.m.d'),
            // 'created_at' => time()
        ]);







    }
}
