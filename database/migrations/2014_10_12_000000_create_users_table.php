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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('location')->nullable();
            $table->text('about')->nullable();
            $table->string('app_user_id')->nullable();
            $table->string('sales_resp_code')->nullable();
            $table->string('company')->nullable();
            $table->string('phone_no')->nullable();
            $table->integer('inquirySettings')->nullable();
            $table->integer('aprovalsSettings')->nullable();
            $table->integer('CRMSettings')->nullable();
            $table->integer('ticketSettings')->nullable();
            $table->integer('lsSettings')->nullable();
            $table->integer('sampleSettings')->nullable();
            $table->string('reset_hash')->nullable();
            $table->string('reset_expires')->nullable();
            $table->integer('usertype')->nullable();
            $table->integer('active')->nullable();
            $table->integer('is_delete')->nullable();
            $table->integer('isadmin')->nullable();
            $table->rememberToken();
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
