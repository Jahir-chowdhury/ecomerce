<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->constrained('orders');
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->foreignId('vendor_product_id')->nullable()->constrained('vendor_products');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->integer('qty')->default(0);
            $table->decimal('total',8,2)->default(0.00);
            $table->decimal('shipp_charge',8,2)->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('refund')->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
