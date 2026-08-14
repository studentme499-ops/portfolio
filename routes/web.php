<?php

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
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    Route::view('/forgot-password', 'admin.forgot-password')->name('forgot-password');

    Route::middleware('auth')->group(function () {
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
        Route::view('/profile', 'admin.profile')->name('profile');
        Route::view('/settings', 'admin.settings')->name('settings');
    });
});
