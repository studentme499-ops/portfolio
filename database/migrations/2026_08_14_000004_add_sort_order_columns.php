<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['certifications', 'testimonials', 'blog_categories', 'blog_posts'] as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->integer('sort_order')->default(0)->after('id');
            });
        }
    }

    public function down(): void
    {
        foreach (['certifications', 'testimonials', 'blog_categories', 'blog_posts'] as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }
    }
};