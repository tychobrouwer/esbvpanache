<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use App\Http\Requests\CommitteeAddRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CalendarController extends Controller
{
    private int $lastCreated;

	public function __contruct() {
		$this->lastCreated = 0;
	}

    /**
     * Show the committee list.
     */
    public function getICAL(): View
    {
		if ($this->lastCreated + 60 * 5 < time()) {
			return response()->file(resaurce_path('panache.ical'));
		}

        $activities = Activity::get();



        // return response
    }
}
