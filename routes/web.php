<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'], function () {
    return view('index');
})->name('index');
Route::get('/board', function () { return view('board'); })->name('board');
Route::get('/activities', function () { return view('activities'); })->name('activities');
Route::get('/contact', function () { return view('contact'); })->name('contact');
Route::get('/history', function () { return view('history'); })->name('history');
Route::get('/committees', function () { return view('committees'); })->name('committees');
Route::get('/member-documents', function () { return view('member-documents'); })->name('member-documents');
Route::get('/training-and-playing', function () { return view('training-and-playing'); })->name('training-and-playing');
Route::get('/membership', function () { return view('membership'); })->name('membership');
Route::get('/competition', function () { return view('competition'); })->name('competition');
Route::get('/pictures', function () { return view('pictures'); })->name('pictures');

Route::get('/admin', [AdminController::class, 'index'], function () {
    return view('admin');
})->middleware(['auth'])->name('admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/announcement', [AnnouncementController::class, 'add'])->name('announcement.add');
    Route::delete('/announcement', [AnnouncementController::class, 'delete'])->name('announcement.delete');
});

Route::middleware('auth')->group(function () {
    Route::post('/activity', [ActivityController::class, 'add'])->name('activity.add');
    Route::delete('/activity', [ActivityController::class, 'delete'])->name('activity.delete');
});


require __DIR__.'/auth.php';
