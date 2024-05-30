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
        Schema::create('drag_drop_answers', function (Blueprint $table) {
            $table->id();
            $table->string('answer');
            $table->foreignId('drag_drop_question_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('blank_index');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drag_drop_answers');
    }
};
