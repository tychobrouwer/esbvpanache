<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Activity;
use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * Display the homepage with recent announcements and activities.
     */
    public function index(): View
    {
        $announcements = Announcement::orderBy('date', 'desc')->take(6)->get();
        $activities = Activity::orderBy('date', 'desc')->take(6)->get();

        return view('index', compact('announcements', 'activities'));
    }
}
