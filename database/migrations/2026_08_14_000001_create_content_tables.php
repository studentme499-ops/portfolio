<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Technologies / Skills
        Schema::create('technologies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            $table->string('experience_level')->nullable();
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Projects
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category')->nullable();
            $table->string('year')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('gallery')->nullable();
            $table->json('technologies')->nullable();
            $table->string('client')->nullable();
            $table->string('project_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('demo_url')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Services
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->json('features')->nullable();
            $table->string('price')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Experience
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('position');
            $table->string('employment_type')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false);
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->json('responsibilities')->nullable();
            $table->json('technologies')->nullable();
            $table->string('company_logo')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Education
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->string('institution');
            $table->string('degree');
            $table->string('field')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->string('certificate')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Certifications
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('organization');
            $table->date('issue_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('credential_id')->nullable();
            $table->string('credential_url')->nullable();
            $table->string('certificate_file')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Testimonials
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('position')->nullable();
            $table->string('company')->nullable();
            $table->string('photo')->nullable();
            $table->text('testimonial');
            $table->tinyInteger('rating')->default(5);
            $table->string('project')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Social Links
        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->string('platform');
            $table->string('icon')->nullable();
            $table->string('url');
            $table->string('username')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_links');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('certifications');
        Schema::dropIfExists('education');
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('services');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('technologies');
    }
};
