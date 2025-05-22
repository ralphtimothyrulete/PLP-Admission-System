<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // Drop the foreign key constraint by its name if it exists
            DB::statement('ALTER TABLE applications DROP FOREIGN KEY IF EXISTS applications_student_id_foreign');
            // Ensure the student_id column is unsigned big integer and nullable
            $table->unsignedBigInteger('student_id')->nullable()->change();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // Drop the foreign key constraint by its name if it exists
            DB::statement('ALTER TABLE applications DROP FOREIGN KEY IF EXISTS applications_student_id_foreign');
            // Ensure the student_id column is unsigned big integer and not nullable
            $table->unsignedBigInteger('student_id')->nullable(false)->change();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }
};