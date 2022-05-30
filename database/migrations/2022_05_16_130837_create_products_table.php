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
            $table->bigIncrements('id');
            $table->bigInteger('seller_id')->unsigned();
            $table->string('product_name');
            $table->string('size');
            $table->string('description');
            $table->integer('price');
            $table->integer('sold_number')->default(0);
            $table->float('rating')->default(0);
            $table->text('image');
            $table->timestamps();
            $table->foreign('seller_id')
                ->references('id')
                ->on('sellers')
                ->onCascade('delete');
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
