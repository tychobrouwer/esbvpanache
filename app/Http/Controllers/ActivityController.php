<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Requests\ActivityAddRequest;
use App\Http\Controllers\CalendarController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
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
    public function store(Request $request): RedirectResponse
    {
        $formId = $request->input('form_id', 'activity-form');
        
        // Create validator with prefixed error bag
        $validator = Validator::make($request->all(), (new ActivityAddRequest())->rules());
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors(), $formId)->withInput();
        }
        
        Activity::create($validator->validated());
        $this->updateCalendar();

        return back()->with('status', 'activity-created');
    }

    /**
     * Update the activity information.
     */
    public function update(Request $request, Activity $activity): RedirectResponse
    {
        $formId = $request->input('form_id', 'activity-form');
        
        // Create validator with prefixed error bag
        $validator = Validator::make($request->all(), (new ActivityAddRequest())->rules());
        
        if ($validator->fails()) {
            return back()->withErrors($validator->errors(), $formId)->withInput();
        }
        
        $activity->update($validator->validated());
        $this->updateCalendar();
        
        return back()->with('status', 'activity-updated');
    }

    private function updateCalendar(): void
    {
        (new CalendarController())->update();
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

        return back()->with('success', 'activity-destroyed');
    }
}
