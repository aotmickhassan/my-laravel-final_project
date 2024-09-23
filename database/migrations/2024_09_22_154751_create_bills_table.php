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
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Define the exam_id column
            $table->unsignedBigInteger('exam_id'); // Define exam_id as unsignedBigInteger

            $table->string('bank_account');
            $table->string('branch_name');
            $table->string('routing_number');
            $table->date('bill_date');
            $table->timestamps();

            // Add the foreign key constraint
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade'); // Set up the foreign key
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
// public function up(): void
    // {
    //     Schema::create('bills', function (Blueprint $table) {
    //         $table->bigIncrements('id');
    //         $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade'); // Foreign Key referencing exams table
    //         $table->string('bank_account');
    //         $table->string('branch_name');
    //         $table->string('routing_number');
    //         $table->date('bill_date');
    //         $table->timestamps();
    //     });
    // }