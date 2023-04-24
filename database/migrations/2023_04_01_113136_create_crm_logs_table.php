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
        Schema::create('crm_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crm_id');
            $table->text('description')->nullable();
            $table->integer('crm_reminder')->nullable();
            $table->timestamp('crm_remind_on')->nullable();
            $table->integer('status')->nullable();
            $table->integer('crm_status')->nullable();
            $table->integer('crm_action')->nullable();
            $table->integer('crm_quatation')->nullable();
            $table->integer('crm_followup')->nullable();
            $table->integer('crm_negosiation')->nullable();
            $table->integer('crm_finalstatus')->nullable();
            $table->string('quatation_attachment')->nullable();
            $table->text('action_message')->nullable();
            $table->timestamp('crm_updation_date_time')->nullable();
            $table->string('quote_estimated_value')->nullable();
            $table->string('updation_attachment')->nullable();
            $table->string('followup_attachment')->nullable();
            $table->string('crm_attachment')->nullable();
            $table->timestamp('crm_followup_date_time')->nullable();
            $table->timestamp('crm_end_date_time')->nullable();
            $table->string('quatation_action_message')->nullable();
            $table->text('followup_action_message')->nullable();
            $table->text('negosiation_action_message')->nullable();
            $table->text('win_action_message')->nullable();
            $table->text('loss_action_message')->nullable();
            $table->timestamps();
            $table->foreign('crm_id')->references('id')->on('crms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_logs');
    }
};
