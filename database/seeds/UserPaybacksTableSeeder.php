<?php

use Illuminate\Database\Seeder;
use App\Entities\UserPayback;

class UserPaybacksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserPayback::create([
            'user_id' => 2,
            'percentage' => 1.5,
            'total' => 15,
            'goal' => 1000,
            'on' => true
        ]);
    }
}
