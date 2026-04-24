<?php

// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\projectController;
use App\Http\Controllers\ticketController;
use App\Http\Controllers\calendarController;
use App\Http\Controllers\trashController;
use App\Http\Controllers\profileController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect('/dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');use Illuminate\Http\Request;
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [dashboardController::class, 'show'])->middleware(['auth', 'verified'])->name('_dashboard.dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name(profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile', [profileController::class, 'show'])->name('_profile.profile');
    Route::post('/profile/update', [profileController::class, 'update'])->name('_profile.update');
    Route::get('/profile/edit', [profileController::class, 'edit'])->name('_profile.edit');
    Route::get('/profile/signout', [profileController::class, 'signOut'])->name('_profile.signout');

});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/status/not_started', [dashboardController::class, 'not_started'])->name('dashboard.status.not_started');
    Route::get('/dashboard/status/low', [dashboardController::class, 'low'])->name('dashboard.status.low');
    Route::get('/dashboard/status/medium', [dashboardController::class, 'medium'])->name('dashboard.status.medium');
    Route::get('/dashboard/status/high', [dashboardController::class, 'high'])->name('dashboard.status.high');
    Route::get('/dashboard/status/critical', [dashboardController::class, 'critical'])->name('dashboard.status.critical');

    Route::get('/projects', [projectController::class, 'index'])->name('_projects.projects');
    Route::get('/projects/new', [projectController::class, 'new'])->name('_projects.new');
    Route::post('/projects/store', [projectController::class, 'store'])->name('_projects.store');
    Route::post('/projects/{id}/update', [projectController::class, 'update'])->name('_projects.update');
    Route::get('/projects/{id}/edit', [projectController::class, 'edit'])->name('_projects.edit');
    Route::get('/projects/{id}/show', [projectController::class, 'show'])->name('_projects.show');
    Route::get('/projects/{id}/remove', [projectController::class, 'remove'])->name('_projects.remove');

    Route::get('/tickets', [ticketController::class, 'index'])->name('_tickets.tickets');
    Route::get('/tickets/new', [ticketController::class, 'new'])->name('_tickets.new');
    Route::post('/tickets/store', [ticketController::class, 'store'])->name('_tickets.store');
    Route::post('/tickets/{id}/update', [ticketController::class, 'update'])->name('_tickets.update');
    Route::get('/tickets/{id}/edit', [ticketController::class, 'edit'])->name('_tickets.edit');
    Route::get('/tickets/{id}/show', [ticketController::class, 'show'])->name('_tickets.show');
    Route::get('/tickets/{id}/remove', [ticketController::class, 'remove'])->name('_tickets.remove');

    Route::get('/calendar', [calendarController::class, 'show'])->name('_calendar.calendar');
    Route::post('/calendar/store', [calendarController::class, 'store'])->name('_calendar.store');

    Route::get('/trash', [trashController::class, 'show'])->name('trash');
});

Route::middleware('auth')->post('/api/token', function (Request $request) {
    return [
        'token' => $request->user()->createToken('api-token')->plainTextToken
    ];
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/calendar/api/events', [calendarController::class, 'get_events_api'])->name('_calendar.get_events');
    Route::post('/calendar/api/events_dot', [calendarController::class, 'get_events_dot_api'])->name('_calendar.get_events_dot');
});