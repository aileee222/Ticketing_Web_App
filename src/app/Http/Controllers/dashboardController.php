<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Project;
use App\Service\StatusService;
use App\Service\UserStatusService;

class dashboardController extends Controller
{
    public function show(StatusService $statusService, UserStatusService $userStatusService) {

        if($userStatusService->info(auth()->user()->status)['label'] != "Client") {
            $tickets = Ticket::all();
            $ticketsCount = Ticket::count();
            $blocInfosTickets = [Ticket::where('status', 0)->count(), Ticket::where('status', 1)->count(), Ticket::where('status', 2)->count(), Ticket::where('status', 3)->count(), Ticket::where('status', 4)->count()];
            
            $projects = Project::all();
            $projectsCount = Project::count();
            $blocInfosProjects = [Project::where('status', 4)->count()];
        }
        else {
            $tickets = Ticket::where('user_id', auth()->id())->get();
            $ticketsCount = Ticket::where('user_id', auth()->id())->count();
            $blocInfosTickets = [Ticket::where('user_id', auth()->id())->where('status', 0)->count(), Ticket::where('user_id', auth()->id())->where('status', 1)->count(), Ticket::where('user_id', auth()->id())->where('status', 2)->count(), Ticket::where('user_id', auth()->id())->where('status', 3)->count(), Ticket::where('user_id', auth()->id())->where('status', 4)->count()];
            
            $projects = Project::where('user_id', auth()->id())->get();
            $projectsCount = Project::where('user_id', auth()->id())->count();
            $blocInfosProjects = [Project::where('user_id', auth()->id())->where('status', 4)->count()];
        }

        $tickets->transform(function ($ticket) use ($statusService) {
			$ticket->status_info = $statusService->info((int) $ticket->status);
			return $ticket;
		});
        
        $projects->transform(function ($project) use ($statusService) {
			$project->status_info = $statusService->info((int) $project->status);
			return $project;
		});

        return view('_dashboard.dashboard', [
            "tickets" => $tickets,
            "projects" => $projects,
            "ticketsCount" => $ticketsCount,
            "projectsCount" => $projectsCount,
            "bloc_infos_ticket" => $blocInfosTickets,
            "bloc_infos_project" => $blocInfosProjects,
        ]);
    }
    public function not_started(StatusService $statusService, UserStatusService $userStatusService) {
        if($userStatusService->info(auth()->user()->status)['label'] != "Client") $tickets = Ticket::where('status', 0)->get();
        else $tickets = Ticket::where('user_id', auth()->id())->where('status', 0)->get();

        $tickets->transform(function ($ticket) use ($statusService) {
			$ticket->status_info = $statusService->info((int) $ticket->status);
			return $ticket;
		});
        return view('_dashboard.status.ns', [
           "tickets" => $tickets,
        ]);
    }
    public function low(StatusService $statusService, UserStatusService $userStatusService) {
        if($userStatusService->info(auth()->user()->status)['label'] != "Client") $tickets = Ticket::where('status', 1)->get();
        else $tickets = Ticket::where('user_id', auth()->id())->where('status', 1)->get();

        $tickets->transform(function ($ticket) use ($statusService) {
			$ticket->status_info = $statusService->info((int) $ticket->status);
			return $ticket;
		});
        return view('_dashboard.status.ns', [
           "tickets" => $tickets,
        ]);
    }
    public function medium(StatusService $statusService, UserStatusService $userStatusService) {
        if($userStatusService->info(auth()->user()->status)['label'] != "Client") $tickets = Ticket::where('status', 2)->get();
        else $tickets = Ticket::where('user_id', auth()->id())->where('status', 2)->get();

        $tickets->transform(function ($ticket) use ($statusService) {
			$ticket->status_info = $statusService->info((int) $ticket->status);
			return $ticket;
		});
        return view('_dashboard.status.ns', [
           "tickets" => $tickets,
        ]);
    }
    public function high(StatusService $statusService, UserStatusService $userStatusService) {
        if($userStatusService->info(auth()->user()->status)['label'] != "Client") $tickets = Ticket::where('status', 3)->get();
        else $tickets = Ticket::where('user_id', auth()->id())->where('status', 3)->get();

        $tickets->transform(function ($ticket) use ($statusService) {
			$ticket->status_info = $statusService->info((int) $ticket->status);
			return $ticket;
		});
        return view('_dashboard.status.ns', [
           "tickets" => $tickets,
        ]);
    }
    public function critical(StatusService $statusService, UserStatusService $userStatusService) {
        if($userStatusService->info(auth()->user()->status)['label'] != "Client") $tickets = Ticket::where('status', 4)->get();
        else $tickets = Ticket::where('user_id', auth()->id())->where('status', 4)->get();

        $tickets->transform(function ($ticket) use ($statusService) {
			$ticket->status_info = $statusService->info((int) $ticket->status);
			return $ticket;
		});
        return view('_dashboard.status.ns', [
           "tickets" => $tickets,
        ]);
    }
}
