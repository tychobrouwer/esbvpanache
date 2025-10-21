<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Http\Requests\AnnouncementAddRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Add the announcement information.
     */
    public function store(Request $request): RedirectResponse
    {
        $formId = $request->input('form_id', 'announcement-form');
        
        // Create validator with prefixed error bag
        $validator = Validator::make($request->all(), (new AnnouncementAddRequest())->rules());
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors(), $formId);
        }
        
        Announcement::create($validator->validated());

        return back()->with('status', 'announcement-created');
    }

    /**
     * Update the announcement information.
     */
    public function update(Request $request, Announcement $announcement): RedirectResponse
    {
        $formId = $request->input('form_id', 'announcement-form');
        
        // Create validator with prefixed error bag
        $validator = Validator::make($request->all(), (new AnnouncementAddRequest())->rules());
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors(), $formId);
        }
        
        $announcement->update($validator->validated());
        
        return back()->with('status', 'announcement-updated');
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

        return back()->with('success', 'announcement-destroyed');
    }
}
