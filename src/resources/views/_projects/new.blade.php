<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('_tickets/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('styles.css') }}" />
    <title>New Project</title>

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
            <span class="playwrite-regular">New</span> Project
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
            <div>New Project</div><br />
            <form id="submitPrjform" class="form_container" action="{{ route('_projects.store') }}" method="POST">
                @csrf
                <div class="projet_deadline_container">
                    <div class="owner_container">
                        <span class="owner_name">Owner(s)</span>
                        <input class="owner_name_entry" list="available_owner" placeholder="owner">
                         <datalist id="available_owner">
                            @foreach ($owners as $owner)
                                <option value="{{ $owner->firstname }} {{ $owner->lastname }}">
                            @endforeach
                        </datalist> 
                        <div id="owner_error" class="error hide">Please add a ticket owner(s).</div>
                    </div>
                    <div class="deadline_container">
                        <span class="deadline">Deadline</span>
                        <div class="deadline_entry_container">
                            <input type="date" class="deadline_entry" placeholder="deadline">
                            <div id="deadline_error" class="error hide">Invalid deadline.</div>
                        </div>  
                    </div>
                    <div class="status_container">
                        <span class="status">Status</span>
                        <input class="status_entry" list="available_status" placeholder="choose a status">
                        <datalist id="available_status">
                            <option value="Not Started">
                            <option value="Low">
                            <option value="Medium">
                            <option value="High">
                            <option value="Critical">
                        </datalist> 
                        <div id="status_error" class="error hide">Invalid status.</div>

                    </div>
                </div>
                <div class="project_name_container">
                    <span class="project_name">Name</span>
                    <input type="text" class="project_name_entry" placeholder="project name">
                    <div id="name_error" class="error hide">Please add a ticket name.</div>
                </div>
                <div class="description_container">
                    <span class="description">Description</span>
                    <textarea class="description_entry" rows="1" placeholder="description"></textarea>
                    <div id="description_error" class="error hide">Please add a ticket description.</div>
                </div>
                <div class="comment_container">
                    <span class="comment">Comment</span>
                    <textarea class="comment_entry" rows="1" placeholder="comment"></textarea>
                    <div id="comment_error" class="error hide">Please add a comment.</div>
                </div>
                <button id="submit" class="confirm_button">Done</button>
            </form>
        </section>
    </div>    
    <script src="{{ asset('script_pt_form.js') }}"></script>
</body>
</html>