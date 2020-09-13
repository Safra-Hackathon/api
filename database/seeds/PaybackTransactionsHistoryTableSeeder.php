<?php

use Illuminate\Database\Seeder;
use App\Entities\PaybackTransactionsHistory;
use Faker\Generator as Faker;
use \Carbon\Carbon;
use \Illuminate\Support\Facades\DB;
use \App\Entities\UserPayback;

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
        $entries = 200;
        $date = Carbon::now();
        $date->subDays($entries);

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

            $date->addDay();
            $i++;
        } while ($i <= $entries);

        $entries += 5;

        DB::statement("ALTER SEQUENCE payback_transactions_history_id_seq RESTART WITH $entries;");
        DB::commit();

        UserPayback::where('user_id', 2)->update(['total' => $payback_total]);
    }
}
