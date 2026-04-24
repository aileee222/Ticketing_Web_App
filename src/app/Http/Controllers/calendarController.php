<?php

namespace App\Http\Controllers;
use App\Models\Calendar; 
use Illuminate\Http\Request;
use App\Http\Requests\StoreEventRequest;

use Carbon\Carbon;

class calendarController extends Controller
{
    public function show() {
	    return view("_calendar.calendar");
    }
    public function store(StoreEventRequest $request) {
		$data = $request->validated();

		Calendar::create([
			'name'        => $data['name'],
			'description' => $data['description'],
			'start'       => $data['start'],
			'end'         => $data['end'],
			'user_id'	  => auth()->id(),
		]);

		return response()->json(['success' => true]);
	}

	public function get_events_api(Request $request)
	{
		$date = $request->input('date');
		$events = Calendar::where('user_id', auth()->id())->whereDate('start', $date)->get(['id','start','end','name','description']);

		return response()->json($events);
	}
	public function get_events_dot_api(Request $request) {
		$month = $request->input('month');
		$year = $request->input('year');
    	$events = Calendar::where('user_id', auth()->id())->whereMonth('start', $month)->whereYear('start', $year)->get(['start'])
		->map(function($event) { return ['date' => Carbon::parse($event->start)->format('Y-m-d')]; });

		return response()->json($events);
	}
}
