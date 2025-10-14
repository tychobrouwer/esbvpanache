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
        $announcements = Announcement::orderBy('created_at', 'desc')->get();
        $activities = Activity::orderBy('created_at', 'desc')->get();
        $general_committees = Committee::orderBy('created_at', 'desc')->where('is_general', true)->get();
        $non_general_committees = Committee::orderBy('created_at', 'desc')->where('is_general', false)->get();

        return view('admin.admin', compact('announcements', 'activities', 'general_committees', 'non_general_committees'));
    }
}
