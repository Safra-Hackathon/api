<?php

use Illuminate\Database\Seeder;
use App\Entities\PaybackTransactionsHistory;
use Faker\Generator as Faker;
use \Carbon\Carbon;

class PaybackTransactionsHistoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        $i = 0;
        $date = Carbon::now();

        $payback_total = 0;
        do {
            $amount = rand(10, 20) * 10;
            $payback_percentage = 1.5;
            $payback_generated = ($payback_percentage * $amount) / 100;
            $payback_total += $payback_generated;

            $fakeTransaction = [
                'transaction_id' => (string) rand(99999, 999999),
                'user_id' => 2,
                'account_id' => "00711234511",
                'transaction_information' => $faker->realText(rand(10, 40)),
                'transaction_amount' => $amount,
                'payback_percentage' => $payback_percentage,
                'payback_generated' => $payback_generated,
                'payback_total' => $payback_total,
                'date' => $date
            ];

            PaybackTransactionsHistory::create($fakeTransaction);

            $date->subDays(1);
            $i++;
        } while ($i <= 200);
    }
}
