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
        Schema::table('applications', function (Blueprint $table) {
            $table->string('first_choice')->after('overall_grade');
            $table->string('second_choice')->after('first_choice');
            $table->string('third_choice')->after('second_choice');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('first_choice');
            $table->dropColumn('second_choice');
            $table->dropColumn('third_choice');
        });
    }
};
