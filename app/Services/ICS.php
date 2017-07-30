<?php

namespace App\Services;


use Carbon\Carbon;

class ICS
{
	private $filename = "Calendar_events";
	private $events = "";
	
	public function __construct($filename)
	{
		$this->filename = $filename;
	}
	
	public function add($start, $end, $name, $description, $location)
	{
		$this->events .= "BEGIN:VEVENT\nDTSTART:" . date("Ymd\THis\Z", strtotime($start)) . "\nDTEND:" . date("Ymd\THis\Z", strtotime($end)) . "\nLOCATION:" . $location . "\nTRANSP: OPAQUE\nSEQUENCE:0\nUID:\nDTSTAMP:" . date("Ymd\THis\Z") . "\nSUMMARY:" . $name . "\nDESCRIPTION:" . $description . "\nPRIORITY:1\nCLASS:PUBLIC\nEND:VEVENT\n";
	}
	
	private function getCalendar()
	{
		return "BEGIN:VCALENDAR\nVERSION:2.0\nMETHOD:PUBLISH\n" . $this->events . "END:VCALENDAR\n";
	}
	
	public function show()
	{
		header("Content-type:text/calendar");
		header('Content-Disposition: attachment; filename="' . $this->filename . '.ics"');
		Header('Content-Length: ' . strlen($this->getCalendar()));
		Header('Connection: close');
		
		echo $this->getCalendar();
	}
}