<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Semua route web aplikasi ada di sini.
| Versi ini tidak menggunakan guard atau middleware khusus.
| Login admin hanya memakai Auth bawaan Laravel.
|
*/

// ------------------------------------------------------------
// Halaman Awal & Tes
// ------------------------------------------------------------
Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return 'Route Test Berhasil!';
});

// ------------------------------------------------------------
// AUTH ADMIN (Tanpa Guard)
// ------------------------------------------------------------

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// ------------------------------------------------------------
// ADMIN DASHBOARD & FITUR-FITUR
// ------------------------------------------------------------

Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Carousel
    Route::resource('carousels', CarouselController::class);

    // Portfolio
    Route::resource('portfolios', PortfolioController::class);

    // Testimonial
    Route::resource('testimonials', TestimonialController::class);

    // Gallery
    Route::resource('galleries', GalleryController::class);

    // Category
    Route::resource('categories', CategoryController::class);

    // About Page
    Route::get('about', [AboutController::class, 'show'])->name('about.show');
    Route::put('about/{id}', [AboutController::class, 'update'])->name('about.update');

    // Contact
    Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // Setting
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings/{id}', [SettingController::class, 'update'])->name('settings.update');
    Route::put('settings', [SettingController::class, 'updateAll'])->name('settings.updateAll');
});
