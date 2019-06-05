<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MerchantsSeedTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('merchants')->delete();
        \DB::table('investment_products')->delete();

        DB::table('merchants')->insert([
            'name' => 'Lotus Halal Capital',
            'email' => 'hello@lotus.com',
            'state' => 'Lagos',
            'country' => 'Nigeria',
            'created_at' => Carbon::parse(now())->format('Y.m.d'),
        ]);

        DB::table('investment_products')->insert([
            'merchant_id' => 1,
            'name' => 'Umaiza Short Term',
            'minimum_capital' => 10000,
            'maximum_capital' => 50000,
            'duration' => 30,
            'forecasted_profit' => 7,
            'created_at' => Carbon::parse(now())->format('Y.m.d'),
        ]);

        DB::table('investment_products')->insert([
            'merchant_id' => 1,
            'name' => 'Umaiza Mid Term',
            'minimum_capital' => 10000,
            'maximum_capital' => 100000,
            'duration' => 60,
            'forecasted_profit' => 7.5,
            'created_at' => Carbon::parse(now())->format('Y.m.d'),
        ]);

        DB::table('investment_products')->insert([
            'merchant_id' => 1,
            'name' => 'Umaiza Long Term',
            'minimum_capital' => 10000,
            'maximum_capital' => 150000,
            'duration' => 39,
            'forecasted_profit' => 8,
            'created_at' => Carbon::parse(now())->format('Y.m.d'),
        ]);


        DB::table('merchants')->insert([
            'name' => 'Sterling Alternative',
            'email' => 'hello@sterling.com',
            'state' => 'Lagos',
            'country' => 'Nigeria',
            'created_at' => Carbon::parse(now())->format('Y.m.d'),
        ]);
        DB::table('merchants')->insert([
            'name' => 'ARM Ethical Investments',
            'email' => 'hello@arm.com',
            'state' => 'Lagos',
            'country' => 'Nigeria',
            'created_at' => Carbon::parse(now())->format('Y.m.d'),
        ]);

    }
}
