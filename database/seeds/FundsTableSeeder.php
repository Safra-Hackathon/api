<?php

use Illuminate\Database\Seeder;
use App\Entities\Funds;

class FundsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Funds::create([
            'name' => 'SAFRA CAP MARKET PREMIUM FIC D (G)',
            'category' => 'REFERENCIADO DI',
            'interest' => 1.48,
            'min' => 1000,
            'admin_tax' => 0.15,
            'withdraw_time' => 0,
        ]);

        Funds::create([
            'name' => 'SAFRA CAP MARKET FI RF CR PR (Q)',
            'category' => 'RENDA FIXA',
            'interest' => 2.52,
            'min' => 2000,
            'admin_tax' => 0.2,
            'withdraw_time' => 7,
        ]);

        Funds::create([
            'name' => 'SAFRA IMA FIC RENDA FIXA (G)',
            'category' => 'ÍNDICE DE PREÇOS',
            'interest' => 7.68,
            'min' => 5000,
            'admin_tax' => 0.5,
            'withdraw_time' => 1,
        ]);

        Funds::create([
            'name' => 'SAFRA CAP MARKET PREMIUM FIC D (G)',
            'category' => '3',
            'interest' => 1.48,
            'min' => 1000,
            'admin_tax' => 0.15,
            'withdraw_time' => 0,
        ]);

        Funds::create([
            'name' => 'SAFRA CARTEIRA CAMBIAL FI (G)',
            'category' => 'CAMBIAL',
            'interest' => 32.24,
            'min' => 10000,
            'admin_tax' => 1,
            'withdraw_time' => 20,
        ]);

        Funds::create([
            'name' => 'SAFRA ABSOLUTO 30 FIC MULTIMER (G)',
            'category' => 'MULTIMERCADOS',
            'interest' => 5.03,
            'min' => 500,
            'admin_tax' => 2,
            'withdraw_time' => 2,
        ]);
    }
}
