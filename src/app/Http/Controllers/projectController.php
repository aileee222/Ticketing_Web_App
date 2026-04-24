<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\User;
use App\Models\TrashProject;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Service\StatusService;
use App\Service\UserStatusService;

class projectController extends Controller
{
  	public function index(StatusService $statusService, UserStatusService $userStatusService) {
		if($userStatusService->info(auth()->user()->status)['label'] != "Client") $projects = Project::all();
		else $projects = Project::where('user_id', auth()->id())->get();

        $projects->transform(function ($project) use ($statusService) {
			$project->status_info = $statusService->info((int) $project->status);
			return $project;
		});

		$userStatus = $userStatusService->info(auth()->user()->status)['label'];

		return view('_projects.projects', [
			'projects' => $projects,
			'userStatus' => $userStatus,
		]);
	} 

	public function show(StatusService $statusService, UserStatusService $userStatusService, $id) {
		if($userStatusService->info(auth()->user()->status)['label'] != "Client") $p = Project::find($id);
		else $p = Project::where('user_id', auth()->id())->find($id);

		$p->status_info = $statusService->info((int) $p->status);
		$userStatus = $userStatusService->info(auth()->user()->status)['label'];

		return view('_projects.show', [
			'project' => $p,
			'userStatus' => $userStatus,
		]);
	}

	public function new(UserStatusService $userStatusService) {
		if ($userStatusService->info(auth()->user()->status)['label'] === 'Developper') {
			return redirect()->route('_projects.projects')->with('error', 'Vous n\'avez pas la permission.');
		}
		return view('_projects.new', ["owners" => User::where('status', 1)->get()]);
	}
	
	public function store(StoreProjectRequest $request) {
		$data = $request->validated();

		Project::create([
			'name' => $data['name'],
			'description' => $data['description'],
			'owner' => $data['owner'],
			'tlimit' => $data['tlimit'],
			'comment' => $data['comment'],
			'status' => $data['status'],
			'user_id' => auth()->id(),
		]);

		return response()->json(['success' => true]);
	}

	public function edit(StatusService $statusService, UserStatusService $userStatusService, $id) {
		if ($userStatusService->info(auth()->user()->status)['label'] === 'Developper') {
			return redirect()->route('_projects.projects')->with('error', 'Vous n\'avez pas la permission.');
		}
		$project = Project::find($id);
		$project->status_info = $statusService->info((int) $project->status);

		$userStatus = $userStatusService->info(auth()->user()->status)['label'];

		return view('_projects.edit', [
			'project' => $project,
			'userStatus' => $userStatus,
		]);
    }

	public function update(StatusService $statusService, UpdateProjectRequest $request, $id) {
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
			Project::find($id)->update($filtered);
		}

		return response()->json(['success' => true]);
	}

	public function remove(UserStatusService $userStatusService, $id) {
		if ($userStatusService->info(auth()->user()->status)['label'] !== 'Manager') {
			return redirect()->route('_projects.projects')->with('error', 'Vous n\'avez pas la permission.');
		}
		$p = Project::find($id);

		TrashProject::create([
            'project_id'  => $p->id,
            'name'        => $p->name,
            'owner'       => $p->owner,
            'description' => $p->description,
            'tlimit'      => $p->tlimit,
			'comment'     => $p->comment,
            'status'      => $p->status,
			'user_id' 	  => auth()->id(),
        ]);
		
		$p->delete();
		return redirect()->action([projectController::class, 'index']);
	}
}
