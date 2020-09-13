<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

class CreatePaybackTransactionsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payback_transactions_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('transaction_id');
            $table->unsignedBigInteger('user_id');
            $table->text('account_id');
            $table->text('transaction_information');
            $table->double('transaction_amount');
            $table->double('payback_percentage');
            $table->double('payback_generated');
            $table->double('payback_total');
            $table->dateTime('date')->default(DB::raw('CURRENT_TIMESTAMP'));;

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payback_transactions_history');
    }
}
