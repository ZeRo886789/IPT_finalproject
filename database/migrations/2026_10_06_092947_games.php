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
        Schema::create('games', function (Blueprint $table) {
    $table->id('game_id');

    $table->foreignId('team_id')
        ->constrained('teams', 'team_id')
        ->cascadeOnDelete();

    $table->date('game_date');
    $table->string('venue');
    $table->time('time');
    $table->string('game_status');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
