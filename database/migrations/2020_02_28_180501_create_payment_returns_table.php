<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    /*
    "code" => "0"
    "message" => null
    "user_id" => "mbeahan@example.net"
    "user_name" => "Dr. Godfrey Larkin III"
    "order_no" => "123456"
    "service_name" => "dmp9"
    "product_name" => "육아 앱"
    "custom_parameter" => "1|육아 앱|598231|1000|2020-02-28|2020-03-28"
    "pgcode" => "creditcard"
    "tid" => "tpay_test-202002288149418"
    "cid" => "8149417"
    "amount" => "1000"
    "pay_info" => "테스트카드"
    "domestic_flag" => "N"
    "install_month" => "00"
    "payhash" => "D36B3611086728B41C4B22D015FF9982740963082FAD45617D5FBBA2BCF2B404"
    "taxfree_amount" => "0"
    "tax_amount" => "91"
    "nonsettle_amount" => "0"
    "transaction_date" => "2020-02-28 17:25:36"
     */

    public function up()
    {
        Schema::create('payment_returns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('message')->nullable();
            $table->string('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('order_no')->nullable();
            $table->string('service_name')->nullable();
            $table->string('product_name')->nullable();
            $table->string('custom_parameter')->nullable();
            $table->string('pgcode')->nullable();
            $table->string('tid')->nullable();
            $table->string('cid')->nullable();
            $table->string('amount')->nullable();
            $table->string('pay_info')->nullable();
            $table->string('domestic_flag')->nullable();
            $table->string('install_month')->nullable();
            $table->string('payhash')->nullable();
            $table->string('taxfree_amount')->nullable();
            $table->string('tax_amount')->nullable();
            $table->string('nonsettle_amount')->nullable();
            $table->dateTime('transaction_date')->nullable();
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
        Schema::dropIfExists('payment_returns');
    }
}
