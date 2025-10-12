<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Requests\ActivityAddRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Add the activity information.
     */
    public function add(ActivityAddRequest $request): RedirectResponse
    {        
        Activity::create(attributes: $request->validated());

        return back()->with('status', value: 'activity-added');
    }

    /**
     * Delete the activity.
     */
    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'activity_id' => 'required|exists:activities,id',
        ]);

        $activity = Activity::find($request->activity_id);
        $activity->delete();

        return redirect()->back()->with('success', 'activity-deleted');
    }
}
