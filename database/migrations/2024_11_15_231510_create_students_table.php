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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('suffix')->nullable();
            $table->integer('age');
            $table->string('sex');
            $table->string('contact_number');
            $table->string('religion');
            $table->string('sports');
            $table->string('residency_status');
            $table->string('district')->nullable();
            $table->string('barangay')->nullable();
            $table->string('non_pasig_resident')->nullable();
            $table->string('address');
            $table->string('email');
            $table->string('talents');
            $table->string('strand');
            $table->string('salary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};