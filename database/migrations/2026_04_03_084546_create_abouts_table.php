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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('draft');
            $table->string('page_banner_image_url')->nullable();
            $table->string('story_title');
            $table->text('story_content');
            $table->string('story_image_url')->nullable();
            $table->string('bts_title');
            $table->string('bts_subtitle')->nullable();
            $table->json('bts_items')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
