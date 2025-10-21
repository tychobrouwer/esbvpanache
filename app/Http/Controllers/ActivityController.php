<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Requests\ActivityAddRequest;
use App\Http\Controllers\CalendarController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ActivityController extends Controller
{
    /**
     * Display a listing of the activities.
     */
    public function index(): View
    {
        $upcomingActivities = Activity::where('date', '>=', now())->orderBy('date', 'asc')->get();
        $pastActivities = Activity::where('date', '<', now())->orderBy('date', 'desc')->get();

        return view('activities', compact('upcomingActivities', 'pastActivities'));
    }

    /**
     * Add the activity information.
     */
    public function create(ActivityAddRequest $request): RedirectResponse
    {        
        Activity::create(attributes: $request->validated());
        (new CalendarController())->update();

        return redirect()->back()->with('status', 'activity-created');
    }

    /**
     * Update the activity information.
     */
    public function update(ActivityAddRequest $request): RedirectResponse
    {
        Activity::find($request->id)->update($request->validated());
        (new CalendarController())->update();

        return redirect()->back()->with('status', 'activity-updated');
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
        (new CalendarController())->update();

        return redirect()->back()->with('success', 'activity-destroyed');
    }
}
