<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/board', function () { return view('board'); })->name('board');
Route::get('/activities', function () { return view('activities'); })->name('activities');
Route::get('/contact', function () { return view('contact'); })->name('contact');
Route::get('/history', function () { return view('history'); })->name('history');
Route::get('/committees', [CommitteeController::class, 'index'])->name('committees');
Route::get('/member-documents', function () { return view('member-documents'); })->name('member-documents');
Route::get('/training-and-playing', function () { return view('training-and-playing'); })->name('training-and-playing');
Route::get('/membership', function () { return view('membership'); })->name('membership');
Route::get('/competition', function () { return view('competition'); })->name('competition');
Route::get('/pictures', function () { return view('pictures'); })->name('pictures');

Route::get('/panache.ical', [CalendarController::class, 'getICAL']);

Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth'])->name('admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/announcement', [AnnouncementController::class, 'create'])->name('announcement.create');
    Route::delete('/announcement', [AnnouncementController::class, 'destroy'])->name('announcement.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/activity', [ActivityController::class, 'create'])->name('activity.create');
    Route::delete('/activity', [ActivityController::class, 'destroy'])->name('activity.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/committee', [CommitteeController::class, 'create'])->name('committee.create');
    Route::delete('/committee', [CommitteeController::class, 'destroy'])->name('committee.destroy');
});

require __DIR__.'/auth.php';
