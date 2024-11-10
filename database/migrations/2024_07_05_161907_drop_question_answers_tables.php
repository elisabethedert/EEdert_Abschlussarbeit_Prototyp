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
        Schema::dropIfExists('multiple_choice_answers');
        Schema::dropIfExists('multiple_choice_questions');
        Schema::dropIfExists('drag_drop_answers');
        Schema::dropIfExists('drag_drop_questions');
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
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
        
        Schema::create('drag_drop_answers', function (Blueprint $table) {
            $table->id();
            $table->string('answer');
            $table->foreignId('drag_drop_question_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('blank_index');
            $table->timestamps();
        });

        Schema::create('multiple_choice_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('topic');
            $table->integer('level');
            $table->string('type');
            $table->integer('lecture');
            $table->integer('unit');
            $table->timestamps();
        });

        Schema::create('multiple_choice_answers', function (Blueprint $table) {
            $table->id();
            $table->string('answer');
            $table->foreignId('multiple_choice_question_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('correct_answer'); //1-correct 0-wrong
            $table->timestamps();
        });
    }
};
