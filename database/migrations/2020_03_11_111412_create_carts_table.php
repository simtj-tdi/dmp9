<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment("id");
            $table->unsignedBigInteger('goods_id')->comment("상품id");
            $table->unsignedBigInteger('order_no')->nullable()->comment("주문번호");
            $table->integer('state')->default(1)->comment("상태");
            $table->date('buy_date')->nullable()->comment("구매일");
            $table->date('memo')->comment("메모");
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
        Schema::dropIfExists('carts');
    }
}
