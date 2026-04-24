<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('styles.css') }} " />
    <link rel="stylesheet" href="{{ asset('_projects/styles.css') }}" />
    <title>My Project</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+J+Guides:ital@0;1&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Delius&display=swap" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>
<body>
    <header>
        <h1>
            <span class="playwrite-regular">My</span> Project
        </h1>
    </header>
    <div class="main">
        <section class="left">
            <div class="types">FOLDERS</div>
            <a class="lefth2" href="{{ route('_dashboard.dashboard') }}">Dashboard</a>
            <a class="lefth2" href="{{ route('_projects.projects') }}">My Projects</a>
            <a class="lefth2" href="{{ route('_tickets.tickets') }}">My Tickets</a>
            <a class="lefth2" href="{{ route('_calendar.calendar') }}">Calendar</a>
            <a class="lefth2" href="{{ route('trash') }}">Trash</a><br />
            <div class="types">SETTINGS</div>
            <a class="lefth2" href="{{ route('_profile.profile') }}">Profile</a>
            <a class="lefth2" href="{{ route('_profile.signout') }}">Sign out</a>
            <a class="lefth2" href="#">Help</a>
        </section>
        <section class="right">
            <div>Current Project</div><br />
            <div class="form_container">
            @if ($project)
            <form id="submit_project" action="{{ route('_projects.update', $project->id) }}" method="POST">
                <div class="owner_deadline_container">
                    <div class="owner_container">
                        <span class="owner_name">Owner(s)</span>
                        <input type="text" class="owner_name_txt" value="{{ $project->owner }}">
                    </div>
                    <div class="deadline_container">
                        <span class="deadline">Deadline</span>
                        <input type="text" class="deadline_txt" value="{{ $project->tlimit }}">
                    </div>
                </div>
                <div class="name_status_container">
                    <div class="project_name_container">
                        <span class="project_name">Name</span>
                        <input type="text" class="project_name_txt" value="{{ $project->name }}}">
                    </div>
                    <div class="status_container">
                        <span class="status_type">Status</span>
                        <input type="text" class="status_txt_edit" value="{{ $project->status_info['label'] }}">
                    </div>
                </div>
                <div class="description_container_project">
                    <span class="description">Description</span>
                    <input type="text" class="description_txt" value="{{ $project->description }}">
                </div>
                <div class="comment_container">
                    <span class="comment">Comment</span>
                    <input type="text" class="comment_txt" value="{{ $project->comment }}">
                </div>
                <div class="info_bar">
                    <button class="edit" onclick="window.location.href = '#';">Edit</button>
                    <button class="favorite">★</button>
                    <button class="new" onclick="window.location.href = '{{ route('_projects.new') }}';">+</button>
                    @if($userStatus === 'Manager')
                        <button class="del" onclick="window.location.href = '{{ route('_projects.remove', $project->id) }}';">🗑️</button>
                    @endif    
                    <button id="submit" type="submit" form="submit_project" class="edit">Done</button>
                </div>
            </form>    
            @else 
                <p>Project not found.</p>
            @endif
            </div>
        </section>
    </div>   
    <script src="{{ asset('_projects/edit.js') }}"></script> 
</body>
</html>
