<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Activity;
use App\Models\Committee;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->take(5)->get();
        $activities = Activity::orderBy('created_at', 'desc')->take(5)->get();
        $general_committees = Committee::orderBy('created_at', 'desc')->where('is_general', true)->take(5)->get();
        $non_general_committees = Committee::orderBy('created_at', 'desc')->where('is_general', false)->take(5)->get();

        return view('admin.admin', compact('announcements', 'activities', 'general_committees', 'non_general_committees'));
    }
}
