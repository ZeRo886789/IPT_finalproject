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
        Schema::create('teams', function (Blueprint $table) {
    $table->id('team_id');

    $table->foreignId('coach_id')
        ->constrained('coaches', 'coach_id')
        ->cascadeOnDelete();

    $table->string('team_name');
    $table->string('city');
    $table->string('tel_no');
    $table->year('founded_year');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
