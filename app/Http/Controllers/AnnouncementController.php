<?php

namespace App\Http\Controllers;

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
        $request->user()->fill($request->validated());
        $request->user()->save();

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
