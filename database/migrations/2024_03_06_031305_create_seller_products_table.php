<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_product_type_id');
            $table->foreign('seller_product_type_id')->references('id')->on('seller_product_types')->onDelete('cascade');
            $table->dateTime('order_date');
            $table->string('rice_percentage_one')->nullable();
            $table->string('rice_percentage_two')->nullable();
            $table->string('weight');
            $table->unsignedBigInteger('measurement_id');
            $table->foreign('measurement_id')->references('id')->on('measurements')->onDelete('cascade');
            $table->string('total_amount');
            $table->string('price');
            $table->string('address');
            // $table->string('media')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_products');
    }
};
