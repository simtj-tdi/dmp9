<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment("id");
            $table->string('company_name')->comment("상호");
            $table->string('company_number')->comment("등록번호");
            $table->string('establishment')->comment("사업장");
            $table->string('ceo')->comment("대표명");
            $table->string('industry')->comment("업태");
            $table->string('company_category')->comment("종목");
            $table->unsignedSmallInteger('month_by')->nullable()->comment("매월 요청");
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
        Schema::dropIfExists('taxes');
    }
}
