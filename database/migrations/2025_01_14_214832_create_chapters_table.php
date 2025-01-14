<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('ai_prompt')->nullable();
            $table->unsignedBigInteger('next_chapter_id')->nullable();
            $table->timestamps();

            // Se vuoi relazionare 'next_chapter_id' con 'id' della stessa tabella
            // $table->foreign('next_chapter_id')->references('id')->on('chapters')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chapters');
    }
};