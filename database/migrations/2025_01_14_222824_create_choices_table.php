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
        Schema::create('choices', function (Blueprint $table) {
            $table->id();

            // Colonna che riferisce il capitolo di origine
            $table->unsignedBigInteger('chapter_id');

            // Testo che appare all'utente, es. "Vai a nord", "Apri la porta..."
            $table->string('label');

            $table->text('result_text')->nullable();

            // Collegamento al capitolo successivo dopo questa scelta
            $table->unsignedBigInteger('next_chapter_id')->nullable();

            $table->timestamps();

            // Foreign key
            $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choices');
    }
};