<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('today_prices', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('type');
            $table->string('sell_price');
            $table->string('buy_price');
            $table->string('rice');
            $table->string('remark');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('today_prices');
    }
};
