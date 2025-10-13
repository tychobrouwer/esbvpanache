<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Requests\ActivityAddRequest;
use App\Http\Controllers\CalendarController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ActivityController extends Controller
{
    /**
     * Add the activity information.
     */
    public function create(ActivityAddRequest $request): RedirectResponse
    {        
        Activity::create(attributes: $request->validated());
        CalendarController::update();

        return redirect()->back()->with('status', value: 'activity-created');
    }

    /**
     * Delete the activity.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'activity_id' => 'required|exists:activities,id',
        ]);

        $activity = Activity::find($request->activity_id);
        $activity->delete();

        return redirect()->back()->with('success', 'activity-destroyed');
    }
}
