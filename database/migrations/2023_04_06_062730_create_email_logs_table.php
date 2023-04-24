<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crm_id');
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            $table->string('attachment')->nullable();
            $table->string('toEmail')->nullable();
            $table->string('ccEmail')->nullable();
            $table->string('bccEmail')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('crm_id')->references('id')->on('crms')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_logs');
    }
};
