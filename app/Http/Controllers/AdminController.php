<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Announcement;
use App\Models\Board;
use App\Models\Committee;
use App\Models\Image;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display a listing of the resources.
     */
    public function index(): View
    {
        $activities = Activity::orderBy('created_at', 'desc')->get();
        $announcements = Announcement::orderBy('created_at', 'desc')->get();
        $general_committees = Committee::orderBy('created_at', 'desc')->where('is_general', true)->get();
        $non_general_committees = Committee::orderBy('created_at', 'desc')->where('is_general', false)->get();
        $boards = Board::orderBy('created_at', 'desc')->get();
        $images = Image::orderBy('created_at', 'desc')->get();

        return view('admin.admin', compact('activities', 'announcements', 'boards', 'images', 'general_committees', 'non_general_committees'));
    }
}
