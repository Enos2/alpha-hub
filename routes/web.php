<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// Home will display latest news
Route::get('/', [NewsController::class, 'index'])->name('home');

// Public can view news detail pages
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');

// Comment submission route (for News or Product)
Route::post('/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');

// Only authenticated users can manage news and profile
Route::middleware(['auth'])->group(function () {
    // Resource routes for authenticated users except 'index' and 'show' (handled above)
    Route::resource('news', NewsController::class)->except(['index', 'show']);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes (register/login/etc.)
require __DIR__.'/auth.php';
