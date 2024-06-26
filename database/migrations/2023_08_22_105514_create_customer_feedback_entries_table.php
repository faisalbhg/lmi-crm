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
        Schema::create('customer_feedback_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('feedback_id');
            $table->integer('feedback_question_id');
            $table->text('feedback_question_qtn');
            $table->string('feedback_answer')->nullable();
            $table->string('is_active')->nullable();
            $table->string('is_deleted')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->foreign('feedback_id')->references('id')->on('customer_feedbacks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_feedback_entries');
    }
};
