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
            $table->unsignedBigInteger('order_no')->nullable()->comment("주문번호");
            $table->integer('state')->default(1)->comment("상태");
            $table->string('advertiser')->comment("광고주");
            $table->string('data_types')->comment("광고형태");
            $table->string('data_target')->comment("타겟 유형");
            $table->string('data_name')->comment("데이터항목");
            $table->string('data_category')->comment("데이터항목");
            $table->text('data_content')->nullable()->comment("설명");
            $table->integer('data_count')->nullable()->comment("데이터수");
            $table->integer('buy_price')->nullable()->comment("구매가격");
            $table->date('buy_date')->nullable()->comment("구매일");
            $table->date('expiration_date')->nullable()->comment("유효기간");
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
