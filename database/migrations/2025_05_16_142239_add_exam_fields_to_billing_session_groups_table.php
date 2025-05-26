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
    Schema::table('billing_session_groups', function (Blueprint $table) {
        $table->string('exam_dept')->nullable()->after('session'); // replace 'column_before' with actual previous column name
        $table->string('year')->nullable();
        $table->string('semester')->nullable();
        $table->date('exam_start_date')->nullable();
        $table->date('exam_end_date')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('billing_session_groups', function (Blueprint $table) {
            //
        });
    }
};
