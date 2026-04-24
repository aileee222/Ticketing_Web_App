<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use App\Models\Project;
use App\Models\TrashTicket;
use Illuminate\Http\Request;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

use App\Service\StatusService;
use App\Service\UserStatusService;
use App\Service\GetTicketInvoicing;

class ticketController extends Controller
{
	public function index(StatusService $statusService, UserStatusService $userStatusService) {
		if($userStatusService->info(auth()->user()->status)['label'] != "Client") $tickets = Ticket::all();
		else $tickets = Ticket::where('user_id', auth()->id())->get();
        
		$tickets->transform(function ($ticket) use ($statusService) {
			$ticket->status_info = $statusService->info((int) $ticket->status);
			return $ticket;
		});

		$userStatus = $userStatusService->info(auth()->user()->status)['label'];

		return view('_tickets.tickets', [
			"tickets" => $tickets,
			'userStatus' => $userStatus,
		]);
	} 
	public function show(StatusService $statusService, UserStatusService $userStatusService, $id) {
		if($userStatusService->info(auth()->user()->status)['label'] != "Client") $t = Ticket::find($id);
		else $t = Ticket::where('user_id', auth()->id())->find($id);

		$t->status_info = $statusService->info((int) $t->status);
		$userStatus = $userStatusService->info(auth()->user()->status)['label'];
		
		return view('_tickets.show', [
			'ticket' => $t,
			'userStatus' => $userStatus,
		]);
	}
	public function new(UserStatusService $userStatusService) {
		if ($userStatusService->info(auth()->user()->status)['label'] === 'Developper') {
			return redirect()->route('_tickets.tickets')->with('error', 'Vous n\'avez pas la permission.');
		}
		return view('_tickets.new', ["projectsN" => Project::select("name")->get()]);
	} 
	public function store(StoreTicketRequest $request, GetTicketInvoicing $getTicketInvoicing) {
		$data = $request->validated();

		Ticket::create([
			'name' => $data['name'], 
			'description' => $data['description'],
			'fromproject' => $data['fromproject'],
			'tlimit' => $data['tlimit'],
			'comment' => $data['comment'],
			'invoicing' => $getTicketInvoicing->get($data['tlimit']),
			'status' => $data['status'],
			'user_id' => auth()->id(),
		]);

		return response()->json(['success' => true]);
	}

	public function edit(StatusService $statusService, UserStatusService $userStatusService, $id) {
		if ($userStatusService->info(auth()->user()->status)['label'] === 'Developper') {
			return redirect()->route('_tickets.tickets')->with('error', 'Vous n\'avez pas la permission.');
		}
		$ticket = Ticket::find($id);
		$ticket->status_info = $statusService->info((int) $ticket->status);

		$userStatus = $userStatusService->info(auth()->user()->status)['label'];

		return view('_tickets.edit', [
			'ticket' => $ticket,
			'userStatus' => $userStatus,
		]);
    }

	public function update(StatusService $statusService, UpdateTicketRequest $request, $id) {
		$validated = $request->validated();

		$presentKeys = array_keys($request->all());
		$filtered = array_intersect_key($validated, array_flip($presentKeys));

		$filtered = array_filter($filtered, function ($v) {
			return !($v === null || $v === '' || (is_array($v) && empty($v)));
		});

		$filtered = array_intersect_key($filtered, array_flip((new \App\Models\Ticket)->getFillable()));

		if (isset($filtered['status'])) {
			$filtered['status'] = $statusService->info((int) $filtered['status'])['value'];
		}
		if (!empty($filtered)) {
			Ticket::find($id)->update($filtered);
		}

		return response()->json(['success' => true]);
	}

	public function remove(UserStatusService $userStatusService, $id) {
		if ($userStatusService->info(auth()->user()->status)['label'] !== 'Manager') {
			return redirect()->route('_projects.projects')->with('error', 'Vous n\'avez pas la permission.');
		}
		$t = Ticket::find($id);
		
		$trash = TrashTicket::create([
            'ticket_id'   => $t->id,
            'name'        => $t->name,
            'fromproject' => $t->fromproject,
            'description' => $t->description,
            'tlimit'      => $t->tlimit,
			'comment'     => $t->comment,
			'invoicing'   => $t->invoicing,
            'status'      => $t->status,
			'user_id' 	  => auth()->id(),
        ]);

		$t->delete();
		return redirect()->action([ticketController::class, 'index']);
	}
}
