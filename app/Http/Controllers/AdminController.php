<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Activity;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->take(5)->get();
        $activities = Activity::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.admin', compact('announcements', 'activities'));
    }
}
