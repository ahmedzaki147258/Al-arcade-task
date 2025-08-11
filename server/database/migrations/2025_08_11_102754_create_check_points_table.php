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
        Schema::create('check_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_lesson_id')->constrained('video_lessons')->cascadeOnDelete();
            $table->integer('timestamp_seconds');
            $table->enum('event_type', ['quiz', 'note', 'popup']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_points');
    }
};
