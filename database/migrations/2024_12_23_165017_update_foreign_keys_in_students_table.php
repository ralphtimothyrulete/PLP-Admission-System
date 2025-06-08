<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Drop the foreign key constraint by its name if it exists
            // DB::statement('ALTER TABLE students DROP FOREIGN KEY IF EXISTS students_user_id_foreign');
            if (Schema::hasColumn('students', 'user_id')) 
                $table->dropForeign(['user_id']);
            // Make user_id nullable before adding the new foreign key
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('school_year')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Drop the foreign key constraint by its name if it exists
            // DB::statement('ALTER TABLE students DROP FOREIGN KEY IF EXISTS students_user_id_foreign');
            if (Schema::hasColumn('students', 'user_id')) 
                $table->dropForeign(['user_id']);
            // Make user_id not nullable again
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};