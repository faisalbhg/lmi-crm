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
        
        Schema::create('custmer_feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('feedback_id');
            $table->text('feedback_question');
            $table->string('feedback_answer')->nullable();
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
            $table->foreign('feedback_id')->references('id')->on('custmer_feedback_values')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custmer_feedback');
    }
};
