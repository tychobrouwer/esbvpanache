<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Requests\ActivityAddRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ActivityController extends Controller
{
    /**
     * Add the activity information.
     */
    public function add(ActivityAddRequest $request): RedirectResponse
    {
        Activity::create($request->validated());

        return Redirect::route('admin')->with('status', 'activity-added');
    }

    /**
     * Delete the activity.
     */
    public function destroy(Request $request): RedirectResponse
    {
        return Redirect::route('admin');
    }
}
