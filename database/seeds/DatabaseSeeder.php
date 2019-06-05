<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserSeederTable::class);
         $this->call(PermisionsSeederTable::class);
//         $this->call(PlanSeederTable::class);
//         $this->call(MerchantsSeedTable::class);
    }
}
