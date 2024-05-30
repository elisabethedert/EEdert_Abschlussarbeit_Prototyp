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
        Schema::create('drag_drop_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('topic');
            $table->integer('level');
            $table->string('type');
            $table->integer('lecture');
            $table->integer('unit');
            $table->json('blanks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drag_drop_questions');
    }
};
