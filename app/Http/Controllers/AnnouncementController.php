<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Http\Requests\AnnouncementAddRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        return Redirect::route('admin')->with('status', 'announcement-added');
    }

    /**
     * Delete the announcement.
     */
    public function destroy(Request $request): RedirectResponse
    {
        return Redirect::route('admin');
    }
}
