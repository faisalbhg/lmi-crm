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
        Schema::create('crms', function (Blueprint $table) {
            $table->id();
            $table->integer('related_to')->nullable();
            $table->integer('deligated_to')->nullable();
            $table->integer('deligated_by')->nullable();
            $table->timestamp('crm_start_date_time')->nullable();
            $table->timestamp('crm_end_date_time')->nullable();
            $table->timestamp('crm_followup_date_time')->nullable();
            $table->text('our_brand')->nullable();
            $table->text('competitor_brand')->nullable();
            $table->string('quote_estimated_value')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('alternative_email')->nullable();
            $table->string('country_code_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('phone_no')->nullable();
            $table->integer('customer_type')->nullable();
            $table->integer('newCustomer')->nullable();
            $table->text('crm_description')->nullable();
            $table->integer('business_category')->nullable();
            $table->integer('marketing_channel')->nullable();
            $table->integer('teritory')->nullable();
            $table->integer('country')->nullable();
            $table->integer('status')->nullable();
            $table->integer('crm_status')->nullable();
            $table->integer('crm_reminder')->nullable();
            $table->timestamp('crm_remind_on')->nullable();
            $table->integer('crm_action')->nullable();
            $table->timestamp('crm_updation_date_time')->nullable();
            $table->integer('crm_quatation')->nullable();
            $table->integer('crm_followup')->nullable();
            $table->integer('crm_negosiation')->nullable();
            $table->integer('crm_finalstatus')->nullable();
            $table->text('crm_attachment')->nullable();
            $table->string('order_number')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('assigned_id')->nullable();
            $table->integer('is_deleted')->nullable();
            $table->timestamps();
            $table->integer('post_to_epicor')->nullable();
            $table->integer('post_epicor_update')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crms');
    }
};
