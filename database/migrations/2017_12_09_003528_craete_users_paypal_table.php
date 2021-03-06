<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CraeteUsersPaypalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypal_users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('ip')->nullable();
            $table->string('country')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement("ALTER TABLE `paypal_users` CHANGE `id` `id` BINARY(16)  NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paypal_users');
    }
}
