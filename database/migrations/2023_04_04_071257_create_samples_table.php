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
        Schema::create('samples', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->integer('crm_id')->nullable();
            $table->string('cust_id')->nullable();
            $table->string('cust_num')->nullable();
            $table->string('cutomer_name')->nullable();
            $table->string('teritory')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();
            $table->text('customer_address')->nullable();
            $table->string('phone_num')->nullable();
            $table->string('email_address')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('partNum')->nullable();
            $table->text('partDescription')->nullable();
            $table->text('prodCode')->nullable();
            $table->integer('status')->nullable();
            $table->integer('department')->nullable();
            $table->integer('is_emailed')->nullable();
            $table->integer('is_deleted')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('samples');
    }
};
