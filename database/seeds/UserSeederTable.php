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
        \DB::table('photos')->delete();
        \DB::table('admins')->delete();

        DB::table('photos')->insert([
            'path' => '1531223048user5-128x128.jpg', 
        ]);

        DB::table('photos')->insert([
            'path' => '1531223232user7-128x128.jpg', 
        ]);

        DB::table('admins')->insert([
            'name' => 'Adebayo',
            'email' => 'ade@gmail.com',
            'status' => 1,
            'photo_id' => 1,
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
        'photo_id' => 2,
        'password' => bcrypt('admin123'),
        'remember_token' => str_random(10),
        'created_at' => Carbon::parse(now())->format('Y.m.d'),
            // 'created_at' => time()
        ]);





        \DB::table('merchants')->delete();
        \DB::table('investment_products')->delete();

        DB::table('merchants')->insert([
            'name' => 'Lotus Halal Capital',
            'code' => 'lothal',
            'email' => 'hello@lotus.com',
            'state' => 'Lagos',
            'country' => 'Nigeria',
            'created_at' => Carbon::parse(now())->format('Y.m.d'),
        ]);

        DB::table('investment_products')->insert([
            'merchant_id' => 1,
            'name' => 'Umaiza Short Term',
            'code' => 'umzshort',
            'minimum_capital' => 10000,
            'maximum_capital' => 50000,
            'duration' => 30,
            'forecasted_profit' => 7,
            'created_at' => Carbon::parse(now())->format('Y.m.d'),
        ]);

        DB::table('investment_products')->insert([
            'merchant_id' => 1,
            'name' => 'Umaiza Mid Term',
            'code' => 'umzmid',
            'minimum_capital' => 10000,
            'maximum_capital' => 100000,
            'duration' => 60,
            'forecasted_profit' => 7.5,
            'created_at' => Carbon::parse(now())->format('Y.m.d'),
        ]);

        DB::table('investment_products')->insert([
            'merchant_id' => 1,
            'name' => 'Umaiza Long Term',
            'code' => 'umzlong',
            'minimum_capital' => 10000,
            'maximum_capital' => 150000,
            'duration' => 39,
            'forecasted_profit' => 8,
            'created_at' => Carbon::parse(now())->format('Y.m.d'),
        ]);


        DB::table('merchants')->insert([
            'name' => 'Sterling Alternative',
            'code' => 'stalt',
            'email' => 'hello@sterling.com',
            'state' => 'Lagos',
            'country' => 'Nigeria',
            'created_at' => Carbon::parse(now())->format('Y.m.d'),
        ]);
        DB::table('merchants')->insert([
            'name' => 'ARM Ethical Investments',
            'code' => 'armlnv',
            'email' => 'hello@arm.com',
            'state' => 'Lagos',
            'country' => 'Nigeria',
            'created_at' => Carbon::parse(now())->format('Y.m.d'),
        ]);


    }
}
