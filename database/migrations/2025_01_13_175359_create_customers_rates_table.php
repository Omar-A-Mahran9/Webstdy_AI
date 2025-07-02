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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();

            $table->string('full_name');
            $table->string('job_position')->nullable();
            $table->string('video_url')->nullable();
            $table->string('audio_url')->nullable();
            $table->text('description')->nullable();
            $table->integer('rate')->default(5);
            $table->longText('comment')->nullable();
            $table->boolean('is_publish')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
