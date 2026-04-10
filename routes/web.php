<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Portfolio routes
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

// Services routes
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Booking routes
Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
Route::get('/booking/status/{booking_code}', [BookingController::class, 'show'])->name('booking.status');
Route::get('/booking/invoice/{booking_code}/preview', [BookingController::class, 'previewInvoice'])->name('booking.invoice.preview');
Route::get('/booking/invoice/{booking_code}/download', [BookingController::class, 'downloadInvoice'])->name('booking.invoice.download');
Route::get('/check-booking', [BookingController::class, 'check'])->name('booking.check');
Route::post('/check-booking', [BookingController::class, 'checkStatus'])->name('booking.check.status');

// About and Contact
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
