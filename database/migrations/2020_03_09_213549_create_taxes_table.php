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
            $table->string('tax_name')->comment("대표자명");
            $table->string('tax_company_name')->comment("업체명");
            $table->string('tax_industry')->comment("업종");
            $table->string('tax_zipcode')->comment("우편번호");
            $table->string('tax_addres_1')->comment("주소");
            $table->string('tax_addres_2')->comment("상세주소");
            $table->string('tax_reference')->nullable()->comment("참고항목");
            $table->string('tax_img')->comment("img_file");
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
