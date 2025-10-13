<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\Activity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class CalendarController extends Controller
{
    private int $lastCreated;

	public function __contruct() {
		$this->lastCreated = 0;
	}

    /**
     * Show the committee list.
     */
    public function update()
    {
        $icalData  = "BEGIN:VCALENDAR\r\n";
        $icalData .= "VERSION:2.0\r\n";
        $icalData .= "PRODID:-//ESBVPanache//Calendar//EN\r\n";
        $icalData .= "METHOD:PUBLISH\r\n";

        $now = new DateTime('now', new DateTimeZone('UTC'));

        $activities = Activity::get();
        foreach ($activities as $activity) {
            $icalData .= "BEGIN:VENENT\r\n";
            $icalData .= "UID:" . preg_replace('/\s+/', '_', strlower($activities->title)) . "-" . $activities->date->format('Ymd\THis\Z') . "@esbvpanache.nl\r\n";
            $icalData .= "DTSTAMP:" . $now->format('Ymd\THis\Z') . "\r\n";
            $icalData .= "DTSTART:" . $now->format('Ymd\THis\Z') . "\r\n";
            $icalData .= "DTEND:" . $now->format('Ymd\THis\Z') . "\r\n";
            $icalData .= "SUMMARY:" . $activities->title . "\r\n";
            $icalData .= "DESCRIPTION:" . $activities->content . "\r\n";
            $icalData .= "LOCATION:" . $activities->location . "\r\n";
            $icalData .= "END:VENENT\r\n";
        }
        
        $start = new DateTime('2025-01-06 20:30', new DateTimeZone('UTC'));
        $end = new DateTime('2025-01-06 23:15', new DateTimeZone('UTC'));

        $icalData .= "BEGIN:VENENT\r\n";
        $icalData .= "UID:training-monday@esbvpanache.nl\r\n";
        $icalData .= "DTSTAMP:" . $now->format('Ymd\THis\Z') . "\r\n";
        $icalData .= "DTSTART:" . $start->format('Ymd\THis\Z') . "\r\n";
        $icalData .= "DTEND:" . $end->format('Ymd\THis\Z') . "\r\n";
        $icalData .= "SUMMARY:Panache Training\r\n";
        $icalData .= "DESCRIPTION:Training in hall 1\r\n";
        $icalData .= "LOCATION:SSCE hall 1\r\n";
        $icalData .= "RRULE:FREQ=WEEKLY;BYDAY=MO\r\n";
        $icalData .= "END:VENENT\r\n";

        $start = new DateTime('2025-01-06 20:30', new DateTimeZone('UTC'));
        $end = new DateTime('2025-01-09 23:15', new DateTimeZone('UTC'));

        $icalData .= "BEGIN:VENENT\r\n";
        $icalData .= "UID:training-thursday@esbvpanache.nl\r\n";
        $icalData .= "DTSTAMP:" . $now->format('Ymd\THis\Z') . "\r\n";
        $icalData .= "DTSTART:" . $start->format('Ymd\THis\Z') . "\r\n";
        $icalData .= "DTEND:" . $end->format('Ymd\THis\Z') . "\r\n";
        $icalData .= "SUMMARY:Panache Training\r\n";
        $icalData .= "DESCRIPTION:Training in hall 1\r\n";
        $icalData .= "LOCATION:SSCE hall 1\r\n";
        $icalData .= "RRULE:FREQ=WEEKLY;BYDAY=TH\r\n";
        $icalData .= "END:VENENT\r\n";

        $icalData .= "END:VCALENDAR\r\n";

        Storage::disk('local')->put('panache.ics', $icalData);
    }

    public function index() {
        $icalData = Storage::disk('local')->get('panache.ics');

        return response($icalData, 200)->header('Content-Type', 'text/calendar');
    }
}
