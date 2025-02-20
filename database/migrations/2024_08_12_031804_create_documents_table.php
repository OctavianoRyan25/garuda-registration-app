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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('family_name');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('birth_date');
            $table->integer('age');
            $table->string('gender');
            $table->string('nationality');
            $table->string('passport_number');
            $table->string('department');
            $table->string('profile_picture');
            $table->string('passport');
            $table->string('research_proposal')->nullable()->default(null);
            $table->string('study_plan');
            $table->string('english_proficiency');
            $table->string('transcript');
            $table->string('cv');
            $table->string('medical_checkup');
            $table->string('first_letter_of_recommendation');
            $table->string('second_letter_of_recommendation')->nullable()->default(null);
            $table->string('commitment_letter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
