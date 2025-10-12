<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Http\Requests\AnnouncementAddRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AnnouncementController extends Controller
{
    /**
     * Add the announcement information.
     */
    public function add(AnnouncementAddRequest $request): RedirectResponse
    {
        Announcement::create(attributes: $request->validated());

        return back()->with('status', value: 'announcement-added');
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
