<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Http\Requests\AnnouncementAddRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Add the announcement information.
     */
    public function create(AnnouncementAddRequest $request): RedirectResponse
    {
        Announcement::create($request->validated());

        return redirect()->back()->with('status', 'announcement-created');
    }

    /**
     * Update the announcement information.
     */
    public function update(AnnouncementAddRequest $request): RedirectResponse
    {        
        Announcement::find($request->id)->update($request->validated());

        return redirect()->back()->with('status', 'announcement-updated');
    }

    /**
     * Delete the announcement.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'announcement_id' => 'required|exists:announcements,id',
        ]);

        $announcement = Announcement::find($request->announcement_id);
        $announcement->delete();

        return redirect()->back()->with('success', 'announcement-destroyed');
    }
}
