<?php

namespace App\Jobs;

use App\Entities\PaybackTransactionsHistory;
use App\Entities\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GeneratePayback implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $transaction;
    protected $accountId;

    /**
     * Create a new job instance.
     *
     * @param $transactions
     * @param string $accountId
     */
    public function __construct($transaction, string $accountId)
    {
        $this->transaction = $transaction['transaction'];
        $this->accountId = $accountId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::where('account_id', $this->accountId)->first();
        $payback = optional($user)->payback()->first();

        // Se não está ligada a funcionalidade, seta payback gerado = 0 mas grava no histórico p/ ter o dado
        $percentage = $payback->on ? (double) $payback->percentage : 0;
        $transactionId = $this->transaction['transactionId'];
        $amount = $this->transaction['amount']['amount'];
        $info = $this->transaction['transactionInformation'];

        $payback_generated = ($percentage * $amount) / 100;

        $payback_total = $payback->total + $payback_generated;

        PaybackTransactionsHistory::create([
            'user_id' => $user->id,
            'account_id' => $this->accountId,
            'transaction_id' => $transactionId,
            'transaction_information' => $info,
            'transaction_amount' => $amount,
            'payback_percentage' => $percentage,
            'payback_generated' => $payback_generated,
            'payback_total' => $payback_total
        ]);

        if ($payback_generated > 0) {
            $payback->update(['total' => $payback_total]);
        }
    }
}
