<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Settings (key-value for hero, about, contact, seo, general, navigation, homepage sections)
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->timestamps();
        });

        // Messages (contact form)
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('subject')->nullable();
            $table->text('message');
            $table->enum('status', ['unread', 'read', 'replied', 'archived', 'spam'])->default('unread');
            $table->text('reply')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });

        // Blog categories
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // Blog posts
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('featured_image')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('blog_categories')->nullOnDelete();
            $table->json('tags')->nullable();
            $table->string('author')->nullable();
            $table->timestamp('publish_date')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->enum('status', ['draft', 'published', 'scheduled', 'archived'])->default('draft');
            $table->timestamps();
        });

        // Media library
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('path');
            $table->string('mime_type')->nullable();
            $table->string('size')->nullable();
            $table->string('collection')->default('general');
            $table->timestamps();
        });

        // Resumes / CV
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('path');
            $table->string('size')->nullable();
            $table->string('version')->default('v1');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        // Navigation items
        Schema::create('navigation_items', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('url');
            $table->boolean('is_external')->default(false);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('navigation_items');
        Schema::dropIfExists('resumes');
        Schema::dropIfExists('media');
        Schema::dropIfExists('blog_posts');
        Schema::dropIfExists('blog_categories');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('settings');
    }
};
