<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Activity logs
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action');
            $table->string('entity_type')->nullable();
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->text('description')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
        });

        // Notifications
        Schema::create('admin_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type');
            $table->string('title');
            $table->text('body')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });

        // Roles & permissions
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->json('permissions')->nullable();
            $table->timestamps();
        });

        // Backups
        Schema::create('backups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path')->nullable();
            $table->string('size')->nullable();
            $table->enum('type', ['database', 'media', 'full'])->default('database');
            $table->timestamps();
        });

        // Page views / analytics
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->string('path')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('device')->nullable();
            $table->string('browser')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
        });

        // Add role_id to users
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->after('id')->constrained('roles')->nullOnDelete();
            $table->string('phone')->nullable()->after('email');
            $table->string('avatar')->nullable()->after('phone');
            $table->boolean('is_active')->default(true)->after('avatar');
            $table->boolean('two_factor_enabled')->default(false)->after('is_active');
            $table->timestamp('last_login_at')->nullable()->after('two_factor_enabled');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('role_id');
            $table->dropColumn(['phone', 'avatar', 'is_active', 'two_factor_enabled', 'last_login_at']);
        });
        Schema::dropIfExists('page_views');
        Schema::dropIfExists('backups');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('admin_notifications');
        Schema::dropIfExists('activity_logs');
    }
};