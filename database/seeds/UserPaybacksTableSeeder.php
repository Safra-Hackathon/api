<?php

use Illuminate\Database\Seeder;
use App\Entities\UserPayback;
use \Illuminate\Support\Facades\DB;

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

        DB::statement("ALTER SEQUENCE user_payback_history_id_seq RESTART WITH 10;");
        DB::commit();
    }
}
