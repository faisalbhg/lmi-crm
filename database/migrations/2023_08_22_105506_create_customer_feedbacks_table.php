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
        Schema::create('customer_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('Company')->nullable();
            $table->string('CustID')->nullable();
            $table->string('CustNum')->nullable();
            $table->string('Name')->nullable();
            $table->string('City')->nullable();
            $table->string('State')->nullable();
            $table->string('Zip')->nullable();
            $table->string('Country')->nullable();
            $table->string('Address1')->nullable();
            $table->string('Address2')->nullable();
            $table->string('Address3')->nullable();
            $table->string('PhoneNum')->nullable();
            $table->string('EMailAddress')->nullable();
            $table->string('AddrList')->nullable();
            $table->string('is_active')->nullable();
            $table->string('is_deleted')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_feedbacks');
    }
};
