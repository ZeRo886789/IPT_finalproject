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
        Schema::create('players', function (Blueprint $table) {
    $table->id('player_id');

    $table->foreignId('team_id')
        ->constrained('teams', 'team_id')
        ->cascadeOnDelete();

    $table->string('name');
    $table->integer('jersey_no');
    $table->string('position');
    $table->integer('age');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
