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
        Schema::create('crm_reminders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crm_id');
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            $table->string('toEmail')->nullable();
            $table->string('toName')->nullable();
            $table->timestamp('date_on')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('status')->nullable();
            $table->integer('is_open')->nullable();
            $table->integer('is_sound')->nullable();
            $table->integer('is_send')->nullable();
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
        Schema::dropIfExists('crm_reminders');
    }
};
