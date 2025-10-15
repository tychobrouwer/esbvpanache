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
     * Show the calendar.
     */
    public function index() {
        $icalData = Storage::disk('local')->get('panache.ics');

        return response($icalData, 200)->header('Content-Type', 'text/calendar');
    }

    /**
     * Update the committee list.
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
            $duration = clone $activity->duration;
            if ($duration === null) {
                $duration = 1;
            }
            $dateEnd = clone $activity->date;
            $dateEnd = $dateEnd->modify("+$duration hours");

            $icalData .= "BEGIN:VEVENT\r\n";
            $icalData .= "UID:" . preg_replace('/\s+/', '_', strtolower($activity->title)) . "-" . $activity->date->format('Ymd\THis\Z') . "@esbvpanache.nl\r\n";
            $icalData .= "DTSTAMP:" . $now->format('Ymd\THis\Z') . "\r\n";
            if ($activity->duration === null && $activity->date->format('H:i') == '00:00') {
                $icalData .= "DTSTART;VALUE=DATE:" . $activity->date->format('Ymd') . "\r\n";
                $icalData .= "DTEND;VALUE=DATE:" . $dateEnd->modify('+1 day')->format('Ymd') . "\r\n";
            } else {
                $icalData .= "DTSTART;TZID=Europe/Amsterdam:" . $activity->date->format('Ymd\THis') . "\r\n";
                $icalData .= "DTEND;TZID=Europe/Amsterdam:" . $dateEnd->format('Ymd\THis') . "\r\n";
            }
            $icalData .= "SUMMARY:" . $activity->title_en . "\r\n";
            $icalData .= "DESCRIPTION:" . $activity->content_en . "\r\n";
            $icalData .= "LOCATION:" . $activity->location_en . "\r\n";
            $icalData .= "END:VEVENT\r\n";
        }

        $start = new DateTime('2025-01-06 20:30');
        $end = new DateTime('2025-01-06 23:15');

        $icalData .= "BEGIN:VEVENT\r\n";
        $icalData .= "UID:training-monday@esbvpanache.nl\r\n";
        $icalData .= "DTSTAMP:" . $now->format('Ymd\THis\Z') . "\r\n";
        $icalData .= "DTSTART;TZID=Europe/Amsterdam:" . $start->format('Ymd\THis') . "\r\n";
        $icalData .= "DTEND;TZID=Europe/Amsterdam:" . $end->format('Ymd\THis') . "\r\n";
        $icalData .= "SUMMARY:Panache Training\r\n";
        $icalData .= "DESCRIPTION:Training in hall 1\r\n";
        $icalData .= "LOCATION:SSCE hall 1\r\n";
        $icalData .= "RRULE:FREQ=WEEKLY;BYDAY=MO\r\n";
        $icalData .= "END:VEVENT\r\n";

        $start = new DateTime('2025-01-09 20:00');
        $end = new DateTime('2025-01-09 23:15');

        $icalData .= "BEGIN:VEVENT\r\n";
        $icalData .= "UID:training-thursday@esbvpanache.nl\r\n";
        $icalData .= "DTSTAMP:" . $now->format('Ymd\THis\Z') . "\r\n";
        $icalData .= "DTSTART;TZID=Europe/Amsterdam:" . $start->format('Ymd\THis') . "\r\n";
        $icalData .= "DTEND;TZID=Europe/Amsterdam:" . $end->format('Ymd\THis') . "\r\n";
        $icalData .= "SUMMARY:Panache Training\r\n";
        $icalData .= "DESCRIPTION:Training in hall 1\r\n";
        $icalData .= "LOCATION:SSCE hall 1\r\n";
        $icalData .= "RRULE:FREQ=WEEKLY;BYDAY=TH\r\n";
        $icalData .= "END:VEVENT\r\n";

        $icalData .= "END:VCALENDAR\r\n";

        Storage::disk('local')->put('panache.ics', $icalData);
    }
}
