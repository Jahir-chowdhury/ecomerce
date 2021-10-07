<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_product_id')->nullable()->constrained('vendor_products');
            $table->string('size')->nullable();
            $table->decimal('sale_price')->nullable();
            $table->decimal('pur_price')->nullable();
            $table->decimal('promo_price')->nullable();
            $table->decimal('discount')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('stock')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attributes');
    }
}
