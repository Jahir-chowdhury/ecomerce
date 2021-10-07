<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorProductAvatarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_product_avatars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_product_id')->nullable()->constrained('vendor_products');
            $table->string('front');
            $table->string('back')->nullable();
            $table->string('left')->nullable();
            $table->string('right')->nullable();
            $table->string('slug');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('vendor_product_avatars');
    }
}
