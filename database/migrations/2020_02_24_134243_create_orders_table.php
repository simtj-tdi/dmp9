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
            $table->unsignedBigInteger('user_id');          // id
            $table->unsignedBigInteger('pyament_id');       // 구매id
            $table->integer('state');                       // 상태
            $table->string('types');                         // 광고형태
            $table->string('data_name');                    // 데이터명
            $table->integer('data_count');                  // 데이터수
            $table->integer('buy_price');                   // 구매가격
            $table->date('buy_date');                       // 구매일
            $table->date('expiration_date');                // 유효기간
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
