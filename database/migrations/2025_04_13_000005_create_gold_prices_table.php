<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoldPricesTable extends Migration
{
    public function up()
    {
        Schema::create('gold_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('gold_type');
            $table->string('type')->nullable();
            $table->string('unit');
            $table->string('price');
            $table->string('currency_code')->nullable();
            $table->string('up_or_down');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
