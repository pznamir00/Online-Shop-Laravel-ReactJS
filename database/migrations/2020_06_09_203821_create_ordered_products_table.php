<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordered_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('size_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->timestamps();
        });

        Schema::table('ordered_products', function(Blueprint $table){
          $table->foreign('product_id')->references('id')->on('products');
          $table->foreign('order_id')->references('id')->on('orders');
          $table->foreign('size_id')->references('id')->on('sizes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordered_products');
    }
}
