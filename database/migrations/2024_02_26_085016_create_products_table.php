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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->string('price')->nullable();
            // $table->string('weight')->nullable();
            // $table->unsignedBigInteger('measurement_id')->nullable();
            // $table->foreign('measurement_id')->references('id')->on('measurements')->onDelete('cascade');
            // $table->unsignedBigInteger('product_category_id')->nullable();
            // $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
            // $table->string('image')->nullable();
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
        Schema::dropIfExists('products');
    }
};
