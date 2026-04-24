<?php

namespace App\Http\Controllers;
use App\Models\TrashProject;
use App\Models\TrashTicket;
use App\Service\StatusService;
use Illuminate\Http\Request;
use App\Service\UserStatusService;

class trashController extends Controller
{
    public function show(StatusService $statusService, UserStatusService $userStatusService) {
		if($userStatusService->info(auth()->user()->status)['label'] != "Client") {
			$tickets = TrashTicket::all();
			$projects = TrashProject::all();
		}
		else {
			$tickets = TrashTicket::where('user_id', auth()->id())->get();
			$projects = TrashProject::where('user_id', auth()->id())->get();
		}
        $tickets->transform(function ($ticket) use ($statusService) {
			$ticket->status_info = $statusService->info((int) $ticket->status);
			return $ticket;
		});
        
        $projects->transform(function ($project) use ($statusService) {
			$project->status_info = $statusService->info((int) $project->status);
			return $project;
		});
	  	return view('trash', ["TTickets" => $tickets, "TProjects" => $projects]);
	}
}
