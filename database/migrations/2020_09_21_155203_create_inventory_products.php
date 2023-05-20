<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        


        Schema::create('inventory_products', function (Blueprint $table) {
            $table->id();
            $table->string('inventory_id');
            $table->string('product_id');
            $table->string('product_sku');
            $table->string('product_name');
            $table->string('product_quantity');
            $table->string('product_price')->nullable();
            $table->timestamps();
        });
    

        Schema::table('products', function (Blueprint $table) {
            $table->bigInteger('stock_quantity')->default(0);
            $table->bigInteger('purchase_quantity')->default(0);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_products');
    }
}
