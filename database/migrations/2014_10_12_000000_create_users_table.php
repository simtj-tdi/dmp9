<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->unique()->comment('user_id');
            $table->string('name')->comment('이름');
            $table->string('password');
            $table->string('email')->comment('이메일');
            $table->string('phone')->comment('전화번호');;
            $table->string('company_name')->comment('회사명');;
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->enum('role',  ['personal', 'company', 'admin'])->default('personal')->comment('role');;
            $table->boolean('approved')->default(false)->comment('승인여부');
            $table->timestamp('approved_at')->nullable()->comment('승인수정일');
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
        Schema::dropIfExists('users');
    }
}
