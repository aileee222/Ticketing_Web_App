<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use App\Models\Project;
use App\Models\Ticket;
use App\Service\UserStatusService;

class profileController extends Controller
{
   public function show(UserStatusService $userStatusService) {
      $user = User::where('id', auth()->user()->id)->get();
      $user->transform(function ($user) use ($userStatusService) {
         $user->status = $userStatusService->info((int) $user->status);
         return $user;
		});

   return view('_profile.profile', [
      "user" => $user->first(),
      "tp" => Project::where('user_id', auth()->id())->count(),
      "tt" => Ticket::where('user_id', auth()->id())->count(),
   ]);
}

   public function edit(UserStatusService $userStatusService) {
      $user = User::where('id', auth()->user()->id)->get();
      $user->transform(function ($user) use ($userStatusService) {
			$user->status = $userStatusService->info((int) $user->status);
			return $user;
		});
      return view('_profile.edit', [
         "user" => $user->first(),
         "tp" => Project::where('user_id', auth()->id())->count(),
         "tt" => Ticket::where('user_id', auth()->id())->count(),
      ]);
   }

   public function update(UpdateUserProfileRequest $request) {
      $validated = $request->validated();

      $presentKeys = array_keys($request->all());
      $filtered = array_intersect_key($validated, array_flip($presentKeys));

      $filtered = array_filter($filtered, function ($v) {
         return !($v === null || $v === '' || (is_array($v) && empty($v)));
      });

      $filtered = array_intersect_key($filtered, array_flip((new \App\Models\User)->getFillable()));

      if (!empty($filtered)) {
         User::whereId(auth()->id())->update($filtered);
      }

      return response()->json(['success' => true]);
   }

   public function signOut() {
      Auth::logout();
      return Redirect::to('/');
   }
}
