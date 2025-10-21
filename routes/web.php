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
Route::get('/activities', [ActivityController::class, 'index'])->name('activities');

Route::get('/about-us/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/about-us/board', [BoardController::class, 'index'])->name('board');
Route::get('/about-us/history', function () { return view('history'); })->name('history');
Route::get('/about-us/committees', [CommitteeController::class, 'index'])->name('committees');
Route::get('/about-us/member-documents', function () { return view('member-documents'); })->name('member-documents');
Route::get('/about-us/pictures', function () { return view('pictures'); })->name('pictures');

Route::get('/playing/training', function () { return view('training'); })->name('training');
Route::get('/playing/membership', function () { return view('membership'); })->name('membership');
Route::get('/playing/competition', function () { return view('competition'); })->name('competition');

Route::get('/panache.ics', [CalendarController::class, 'index']);

Route::get('/locale-switch', function() {    
    $newLocale = App::isLocale('nl') ? 'en' : 'nl';
    App::setLocale($newLocale);
    Session::put('locale', $newLocale);

    return back();
})->name('locale-switch');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    Route::post('/activities', [ActivityController::class, 'store'])->name('activity.store');
    Route::put('/activities/{activity}', [ActivityController::class, 'update'])->name('activity.update');
    Route::delete('/activities', [ActivityController::class, 'destroy'])->name('activity.destroy');

    Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcement.store');
    Route::put('/announcements/{announcement}', [ActivityController::class, 'update'])->name('announcement.update');
    Route::delete('/announcements', [AnnouncementController::class, 'destroy'])->name('announcement.destroy');

    Route::post('/boards', [BoardController::class, 'store'])->name('board.store');
    Route::put('/boards/{board}', [BoardController::class, 'update'])->name('board.update');
    Route::delete('/boards', [BoardController::class, 'destroy'])->name('board.destroy');

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
