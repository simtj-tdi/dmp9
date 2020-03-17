<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment("user_id");
            $table->unsignedBigInteger('cart_id')->comment("cart_id");
            $table->unsignedBigInteger('platform_id')->comment("platform_id");
            $table->string('sns_id')->nullable()->comment("platform_id");
            $table->string('sns_password')->nullable()->comment("platform_password");
            $table->integer('state')->default(1)->comment("상태");
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
        Schema::dropIfExists('options');
    }
}
