<?php
declare(string_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post(
    'bookmarks',
    App\Http\Controllers\Bookmarks\StoreController::class,
)->middleware(['auth'])->name('bookmarks.store');

Route::delete(
    'bookmarks/{bookmark}',
    App\Http\Controllers\Bookmarks\DeleteController::class,
)->middleware(['auth'])->name('bookmarks.delete');

Route::get(
    'bookmarks/{bookmark}',
    App\Http\Controllers\Bookmarks\RedirectController::class
)->middleware(['auth'])->name('bookmarks.redirect');

require __DIR__.'/auth.php';
