<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PlanSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('plans')->delete();

        DB::table('plans')->insert([
            'name' => 'Short Term',
            'time_range' => 30,
            'profit' => 5,
            'lowest_amount' => 1000,
            'created_at' => Carbon::parse(now())->format('Y.m.d'),
        ]);

        DB::table('plans')->insert([
            'name' => 'Mid Term',
            'time_range' => 60,
            'profit' => 10,
            'lowest_amount' => 2000,
            'created_at' => Carbon::parse(now())->format('Y.m.d'),
        ]);

        DB::table('plans')->insert([
            'name' => 'Long Term',
            'time_range' => 90,
            'profit' => 15,
            'lowest_amount' => 5000,
            'created_at' => Carbon::parse(now())->format('Y.m.d'),
        ]);
    }
}
