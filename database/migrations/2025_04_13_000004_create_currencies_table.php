<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('currency_code');
            $table->integer('rate');
            $table->decimal('buy_rate', 15, 2);
            $table->decimal('sell_rate', 15, 2);
            $table->string('up_or_down')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
