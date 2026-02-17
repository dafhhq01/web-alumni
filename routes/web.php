<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlumniProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\AdminAlumniController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminDonationController;
use App\Http\Controllers\Public\PublicNewsController;
use App\Http\Controllers\Public\PublicEventController;
use App\Http\Controllers\Public\PublicGalleryController;
use App\Http\Controllers\Public\PublicAlumniController;
use App\Http\Controllers\Public\PublicDonationController;
use Illuminate\Support\Facades\Route;


// PUBLIC ROUTES (tidak perlu login)

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/news', [PublicNewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [PublicNewsController::class, 'show'])->name('news.show');

Route::get('/events', [PublicEventController::class, 'index'])->name('events.index');
Route::get('/events/{slug}', [PublicEventController::class, 'show'])->name('events.show');

Route::get('/gallery', [PublicGalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/{album}', [PublicGalleryController::class, 'album'])->name('gallery.album');

Route::get('/alumni', [PublicAlumniController::class, 'index'])->name('alumni.directory');
Route::get('/alumni/{id}', [PublicAlumniController::class, 'show'])->name('alumni.show');

Route::get('/donations', [PublicDonationController::class, 'index'])->name('donations.index');


// AUTH ROUTES (dari Breeze)

require __DIR__.'/auth.php';


// ALUMNI ROUTES (harus login + role alumni)

Route::middleware(['auth', 'verified', 'role:alumni'])
    ->prefix('alumni')
    ->name('alumni.')
    ->group(function () {

    // Profile
    Route::get('/profile', [AlumniProfileController::class, 'show'])->name('profile');
    Route::get('/profile/complete', [AlumniProfileController::class, 'complete'])->name('profile.complete');
    Route::post('/profile/complete', [AlumniProfileController::class, 'storeComplete'])->name('profile.complete.store');
    Route::get('/profile/edit', [AlumniProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [AlumniProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/picture', [AlumniProfileController::class, 'uploadPicture'])->name('profile.picture');
    Route::patch('/profile/privacy', [AlumniProfileController::class, 'togglePrivacy'])->name('profile.privacy');
});


// ADMIN ROUTES (harus login + role admin)

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Alumni Management
    Route::get('/alumni', [AdminAlumniController::class, 'index'])->name('alumni.index');
    Route::get('/alumni/export', [AdminAlumniController::class, 'export'])->name('alumni.export');
    Route::get('/alumni/{id}', [AdminAlumniController::class, 'show'])->name('alumni.show');
    Route::patch('/alumni/{id}/verify', [AdminAlumniController::class, 'verify'])->name('alumni.verify');
    Route::delete('/alumni/{id}', [AdminAlumniController::class, 'destroy'])->name('alumni.destroy');

    // News Management
    Route::get('/news', [AdminNewsController::class, 'index'])->name('news.index');
    Route::get('/news/create', [AdminNewsController::class, 'create'])->name('news.create');
    Route::post('/news', [AdminNewsController::class, 'store'])->name('news.store');
    Route::get('/news/{id}/edit', [AdminNewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{id}', [AdminNewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{id}', [AdminNewsController::class, 'destroy'])->name('news.destroy');
    Route::patch('/news/{id}/publish', [AdminNewsController::class, 'togglePublish'])->name('news.publish');

    // Events Management
    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [AdminEventController::class, 'create'])->name('events.create');
    Route::post('/events', [AdminEventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}/edit', [AdminEventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [AdminEventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [AdminEventController::class, 'destroy'])->name('events.destroy');
    Route::patch('/events/{id}/publish', [AdminEventController::class, 'togglePublish'])->name('events.publish');

    // Gallery Management
    Route::get('/gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/create', [AdminGalleryController::class, 'create'])->name('gallery.create');
    Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
    Route::delete('/gallery/{id}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');

    // Donation Management
    Route::get('/donations', [AdminDonationController::class, 'index'])->name('donations.index');
    Route::get('/donations/create', [AdminDonationController::class, 'create'])->name('donations.create');
    Route::post('/donations', [AdminDonationController::class, 'store'])->name('donations.store');
    Route::get('/donations/{id}/edit', [AdminDonationController::class, 'edit'])->name('donations.edit');
    Route::put('/donations/{id}', [AdminDonationController::class, 'update'])->name('donations.update');
    Route::delete('/donations/{id}', [AdminDonationController::class, 'destroy'])->name('donations.destroy');
});