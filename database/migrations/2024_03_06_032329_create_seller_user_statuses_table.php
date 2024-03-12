<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('seller_user_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_product_id'); // Seller_Product_Id field
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('status_id'); 
            $table->dateTime('date'); 
            $table->foreign('seller_product_id')->references('id')->on('seller_products');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seller_user_statuses');
    }
};
