<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\ContactSettingsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\NavigationController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ResumeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SecurityController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'portfolio.home')->name('home');
Route::view('/about', 'portfolio.about')->name('about');
Route::view('/projects', 'portfolio.projects')->name('projects');
Route::view('/services', 'portfolio.services')->name('services');
Route::view('/contact', 'portfolio.contact')->name('contact');

Route::get('/projects/{slug}', function ($slug) {
    $projects = [
        'sokoni-marketplace' => [
            'title' => 'Sokoni Marketplace',
            'category' => 'E-Commerce Platform',
            'overview' => 'Sokoni Marketplace was engineered to resolve critical payment & inventory scaling issues in modern e-commerce across East Africa.',
            'challenge' => 'Legacy backend structures resulted in duplicated checkout orders and poor API performance under load spikes.',
            'client' => 'Sokoni Ltd',
            'role' => 'Lead Architect',
            'duration' => '6 Months',
            'status' => 'Live Production',
        ],
        'healthtrack-pro' => [
            'title' => 'HealthTrack Pro',
            'category' => 'Healthcare App',
            'overview' => 'HealthTrack Pro is a patient management system featuring dynamic appointment scheduling, HIPAA-compliant medical records, and live analytics.',
            'challenge' => 'Sensitive medical data required rigorous encryption and role-based access control while maintaining low-latency query performance.',
            'client' => 'MediCare Group',
            'role' => 'Full Stack Engineer',
            'duration' => '8 Months',
            'status' => 'Live Production',
        ],
        'devflow-ci-cd' => [
            'title' => 'DevFlow CI/CD',
            'category' => 'Developer Tool',
            'overview' => 'DevFlow is a continuous integration platform designed with automated testing flows, customizable deployment pipelines, and team integrations.',
            'challenge' => 'Distributed teams needed a unified pipeline that could scale parallel builds without degrading developer velocity.',
            'client' => 'DevFlow Inc.',
            'role' => 'Backend Engineer',
            'duration' => '4 Months',
            'status' => 'In Development',
        ],
    ];

    abort_unless(isset($projects[$slug]), 404);

    return view('portfolio.project-detail', ['project' => $projects[$slug]]);
})->name('project.detail');

Route::prefix('admin')->name('admin.')->group(function () {
    // -------- Auth --------
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/forgot-password', [AuthController::class, 'showForgot'])->name('forgot-password');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('forgot-password.send');
    Route::get('/reset-password', [AuthController::class, 'showReset'])->name('reset-password');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password.post');
    Route::get('/verify-email', [AuthController::class, 'showVerifyEmail'])->name('verify-email');
    Route::get('/2fa', [AuthController::class, 'show2fa'])->name('2fa');
    Route::post('/2fa', [AuthController::class, 'verify2fa'])->name('2fa.verify');

    Route::middleware('auth')->group(function () {
        // -------- Dashboard --------
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // -------- Profile --------
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
        Route::post('/profile/2fa', [ProfileController::class, 'toggle2fa'])->name('profile.2fa');

        // -------- Website sections --------
        Route::get('/homepage', [HomepageController::class, 'edit'])->name('homepage');
        Route::post('/homepage', [HomepageController::class, 'update'])->name('homepage.update');

        Route::get('/about', [AboutController::class, 'edit'])->name('about');
        Route::post('/about', [AboutController::class, 'update'])->name('about.update');

        // -------- Content resources --------
        Route::resource('projects', ProjectController::class)->except(['show']);
        Route::resource('technologies', TechnologyController::class)->except(['show']);
        Route::resource('services', ServiceController::class)->except(['show']);
        Route::resource('experience', ExperienceController::class)->except(['show']);
        Route::resource('education', EducationController::class)->except(['show']);
        Route::resource('certifications', CertificationController::class)->except(['show']);
        Route::resource('testimonials', TestimonialController::class)->except(['show']);
        Route::resource('social-links', SocialLinkController::class)->except(['show']);
        Route::resource('navigation', NavigationController::class)->except(['show']);
        Route::resource('blog-categories', BlogCategoryController::class)->except(['show']);
        Route::resource('blog', BlogController::class)->except(['show']);

        // -------- Messages --------
        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/{message}', [MessageController::class, 'update'])->name('messages.update');
        Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

        // -------- Media --------
        Route::get('/media', [MediaController::class, 'index'])->name('media.index');
        Route::get('/media/upload', [MediaController::class, 'create'])->name('media.create');
        Route::post('/media', [MediaController::class, 'store'])->name('media.store');
        Route::post('/media/{medium}/copy-url', [MediaController::class, 'copyUrl'])->name('media.copy-url');
        Route::delete('/media/{medium}', [MediaController::class, 'destroy'])->name('media.destroy');

        // -------- Resume / CV --------
        Route::get('/resume', [ResumeController::class, 'index'])->name('resume.index');
        Route::post('/resume', [ResumeController::class, 'store'])->name('resume.store');
        Route::post('/resume/{resume}/activate', [ResumeController::class, 'setActive'])->name('resume.activate');
        Route::get('/resume/{resume}/download', [ResumeController::class, 'download'])->name('resume.download');
        Route::delete('/resume/{resume}', [ResumeController::class, 'destroy'])->name('resume.destroy');

        // -------- Settings --------
        Route::get('/contact-settings', [ContactSettingsController::class, 'edit'])->name('contact-settings');
        Route::post('/contact-settings', [ContactSettingsController::class, 'update'])->name('contact-settings.update');

        Route::get('/settings', [SettingsController::class, 'edit'])->name('settings');
        Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

        Route::get('/seo', [SeoController::class, 'edit'])->name('seo');
        Route::post('/seo', [SeoController::class, 'update'])->name('seo.update');

        Route::get('/security', [SecurityController::class, 'edit'])->name('security');
        Route::post('/security/password', [SecurityController::class, 'changePassword'])->name('security.password');
        Route::post('/security/2fa', [SecurityController::class, 'toggle2fa'])->name('security.2fa');
        Route::post('/security/sessions', [SecurityController::class, 'revokeSessions'])->name('security.sessions');

        // -------- Notifications --------
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::post('/notifications/{notification}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
        Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.read-all');
        Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

        // -------- Analytics --------
        Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');

        // -------- Activity logs --------
        Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs');
        Route::delete('/activity-logs', [ActivityLogController::class, 'clear'])->name('activity-logs.clear');
        Route::delete('/activity-logs/{log}', [ActivityLogController::class, 'destroy'])->name('activity-logs.destroy');

        // -------- Administration --------
        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('roles', RoleController::class)->except(['show']);

        // -------- System --------
        Route::get('/backups', [BackupController::class, 'index'])->name('backups.index');
        Route::post('/backups', [BackupController::class, 'create'])->name('backups.create');
        Route::get('/backups/{backup}/download', [BackupController::class, 'download'])->name('backups.download');
        Route::delete('/backups/{backup}', [BackupController::class, 'destroy'])->name('backups.destroy');

        Route::get('/system', [SystemController::class, 'index'])->name('system');
    });
});
