<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Http\Requests\AnnouncementAddRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    /**
     * Add the announcement information.
     */
    public function add(AnnouncementAddRequest $request): RedirectResponse
    {
        Announcement::create($request->validated());

        return redirect()->back()->with('success', 'announcement-added');
    }

    /**
     * Delete the announcement.
     */
    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'announcement_id' => 'required|exists:announcements,id',
        ]);

        $announcement = Announcement::find($request->announcement_id);
        $announcement->delete();

        return Redirect::route('admin')->with('status', 'announcement-deleted');
    }
}
