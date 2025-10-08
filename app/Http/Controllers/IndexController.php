<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Activity;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function index(): View
    {
        $announcements = Announcement::orderBy('date', 'desc')->take(5)->get();
        $activities = Activity::orderBy('date', 'desc')->take(5)->get();

        return view('index', compact('announcements', 'activities'));
    }
}
