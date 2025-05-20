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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->string('word'); 
            $table->integer('points'); 
            $table->string('used_letters'); 
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->unique(['game_id', 'word']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
