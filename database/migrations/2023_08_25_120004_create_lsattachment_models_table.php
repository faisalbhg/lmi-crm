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
        Schema::create('lsattachment_models', function (Blueprint $table) {
            $table->id();
            $table->integer('ordder_id')->nullable();
            $table->integer('referenceNumber')->nullable();
            $table->integer('aocId')->nullable();
            $table->text('address')->nullable();
            $table->double('latitude', 10, 2)->nullable();
            $table->double('longitude', 10, 2)->nullable();
            $table->integer('isVerified')->nullable();
            $table->string('lastVerifiedByUser')->nullable();
            $table->dateTime('lastVerifiedTime')->nullable();
            $table->string('locationGlobalId')->nullable();
            $table->integer('capacity')->nullable();
            $table->integer('volume')->nullable();
            $table->integer('dropDuration')->nullable();
            $table->integer('zoneId')->nullable();
            $table->string('zoneName')->nullable();
            $table->integer('collection')->nullable();
            $table->integer('priority')->nullable();
            $table->double('factCost', 10, 2)->nullable();
            $table->string('area')->nullable();
            $table->integer('orderNumberLm')->nullable();
            $table->string('nameOfSalesPerson')->nullable();
            $table->string('modeOfPayment')->nullable();
            $table->string('temperature')->nullable();
            $table->double('invoiceAmount', 10, 2)->nullable();
            $table->string('dropWindow_startTime')->nullable();
            $table->string('dropWindow_endTime')->nullable();
            $table->dateTime('orderLsDate')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lsattachment_models');
    }
};
