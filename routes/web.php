<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('index'); })->name('index');
Route::get('/board', function () { return view('board'); })->name('board');
Route::get('/activities', function () { return view('activities'); })->name('activities');
Route::get('/contact', function () { return view('contact'); })->name('contact');
Route::get('/history', function () { return view('history'); })->name('history');

Route::get('/admin', function () {
    return view('admin/admin');
})->middleware(['auth'])->name('admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/announcement', [AnnouncementController::class, 'add'])->name('announcement.add');
    Route::delete('/announcement', [AnnouncementController::class, 'destroy'])->name('announcement.destroy');
});

require __DIR__.'/auth.php';
