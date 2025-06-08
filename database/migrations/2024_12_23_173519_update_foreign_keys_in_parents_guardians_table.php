<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('parents_guardians', function (Blueprint $table) {
            // Drop the foreign key constraint by its name if it exists
            // DB::statement('ALTER TABLE applications DROP FOREIGN KEY IF EXISTS parents_guardians_student_id_foreign');
            if (Schema::hasColumn('parents_guardians', 'student_id')) 
                $table->dropForeign(['student_id']);
            // Ensure the student_id column is unsigned big integer and nullable
            $table->unsignedBigInteger('student_id')->nullable()->change();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('parents_guardians', function (Blueprint $table) {
            // Drop the foreign key constraint by its name if it exists
            // DB::statement('ALTER TABLE applications DROP FOREIGN KEY IF EXISTS parents_guardians_student_id_foreign');
            if (Schema::hasColumn('parents_guardians', 'student_id')) 
                $table->dropForeign(['student_id']);
            // Ensure the student_id column is unsigned big integer and not nullable
            $table->unsignedBigInteger('student_id')->nullable(false)->change();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }
};