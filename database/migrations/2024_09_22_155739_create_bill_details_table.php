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
        Schema::create('bill_details', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary Key
            $table->unsignedBigInteger('billing_sector_id');
            $table->string('billing_session_group')->nullable();
            $table->unsignedBigInteger('bill_id');
            $table->string('course_code');
            $table->integer('count'); // Assuming count is an integer
            $table->boolean('is_full_paper'); // Assuming it's a boolean
            $table->decimal('rate', 8, 2); // Rate as decimal (8 digits total, 2 after decimal)
            $table->integer('quantity');
            $table->foreign('billing_sector_id') // Foreign Key referencing billing_sectors
                ->references('id')->on('billing_sectors')->onDelete('cascade');
            $table->foreign('bill_id') // Foreign Key referencing bills
                ->references('id')->on('bills')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_details');
    }
};
