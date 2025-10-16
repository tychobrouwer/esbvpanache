<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/board', [BoardController::class, 'index'])->name('board');
Route::get('/activities', [ActivityController::class, 'index'])->name('activities');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/history', function () { return view('history'); })->name('history');
Route::get('/committees', [CommitteeController::class, 'index'])->name('committees');
Route::get('/member-documents', function () { return view('member-documents'); })->name('member-documents');
Route::get('/training-and-playing', function () { return view('training-and-playing'); })->name('training-and-playing');
Route::get('/membership', function () { return view('membership'); })->name('membership');
Route::get('/competition', function () { return view('competition'); })->name('competition');
Route::get('/pictures', function () { return view('pictures'); })->name('pictures');
Route::get('/panache.ics', [CalendarController::class, 'index']);

Route::get('/locale-switch', function() {    
    $newLocale = App::isLocale('nl') ? 'en' : 'nl';
    App::setLocale($newLocale);
    Session::put('locale', $newLocale);

    return back();
})->name('locale-switch');



Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    Route::post('/activity', [ActivityController::class, 'create'])->name('activity.create');
    Route::patch('/activity', [ActivityController::class, 'update'])->name('activity.update');
    Route::delete('/activity', [ActivityController::class, 'destroy'])->name('activity.destroy');

    Route::post('/announcement', [AnnouncementController::class, 'create'])->name('announcement.create');
    Route::patch('/announcement', [AnnouncementController::class, 'update'])->name('announcement.update');
    Route::delete('/announcement', [AnnouncementController::class, 'destroy'])->name('announcement.destroy');

    Route::post('/board', [BoardController::class, 'create'])->name('board.create');
    Route::patch('/board', [BoardController::class, 'update'])->name('board.update');
    Route::delete('/board', [BoardController::class, 'destroy'])->name('board.destroy');

    Route::post('/committee', [CommitteeController::class, 'create'])->name('committee.create');
    Route::patch('/committee', [CommitteeController::class, 'update'])->name('committee.update');
    Route::delete('/committee', [CommitteeController::class, 'destroy'])->name('committee.destroy');

    Route::post('/image', [ImageController::class, 'create'])->name('image.create');
    Route::delete('/image', [ImageController::class, 'destroy'])->name('image.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
