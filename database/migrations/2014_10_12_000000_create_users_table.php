<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('email',100);
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('phn',50)->nullable();
            $table->string('address')->nullable();
            $table->string('avatar')->nullable();
            $table->decimal('e_money',8,2)->default(0.00);
            $table->string('role')->default('user');
            $table->boolean('status')->default(false);
            $table->string('verification_token')->nullable();
            $table->boolean('verified')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
