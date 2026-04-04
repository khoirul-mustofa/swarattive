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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('image_url');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('image_url');
        });

        Schema::table('team_members', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('image_url');
        });

        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('image_url');
            $table->json('gallery_image_paths')->nullable()->after('gallery_images');
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('image_url');
        });

        Schema::table('abouts', function (Blueprint $table) {
            $table->string('page_banner_image_path')->nullable()->after('page_banner_image_url');
            $table->string('story_image_path')->nullable()->after('story_image_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });

        Schema::table('team_members', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });

        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->dropColumn(['image_path', 'gallery_image_paths']);
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });

        Schema::table('abouts', function (Blueprint $table) {
            $table->dropColumn(['page_banner_image_path', 'story_image_path']);
        });
    }
};
