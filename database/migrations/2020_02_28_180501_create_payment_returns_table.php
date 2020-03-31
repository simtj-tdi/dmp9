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
            $table->string('account_no')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_holder')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('expire_date')->nullable();
            $table->string('expire_time')->nullable();
            $table->string('issue_tid')->nullable();
            $table->string('cash_receipt_type')->nullable();
            $table->string('tid')->nullable();
            $table->string('cid')->nullable();
            $table->string('pay_info')->nullable();
            $table->string('domestic_flag')->nullable();
            $table->string('install_month')->nullable();
            $table->string('taxfree_amount')->nullable();
            $table->string('tax_amount')->nullable();
            $table->string('nonsettle_amount')->nullable();
            $table->string('payhash')->nullable();
            $table->string('amount')->nullable();
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
