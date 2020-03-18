<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment("id");
            $table->unsignedBigInteger('payment_id')->nullable()->comment("구매id");
            $table->unsignedBigInteger('order_no')->comment("주문번호");
            $table->string('order_name')->comment("구매이름");
            $table->text('goods_info')->comment("상품정보");
            $table->integer('state')->default(1)->comment("상태");
            $table->integer('tax_state')->default(1)->comment("계산서요청상태");
            $table->integer('total_count')->nullable()->comment("총구매데이터수");
            $table->integer('total_price')->nullable()->comment("총구매가격");
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
        Schema::dropIfExists('orders');
    }
}
