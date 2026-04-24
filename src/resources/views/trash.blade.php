<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('styles.css') }}" />
    <title>Trash</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+J+Guides:ital@0;1&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Delius&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>
            <span class="playwrite-regular">My</span> Trash
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
            <div>Current tickets</div>
            <div class="trash_projects_wrapper">
                <table class="tickets_list">
                    <thead>
                        <tr>
                            <th><button id="tickets_list_sort_id" class="tickets_list_sort">ID</button></th>
                            <th><button id="tickets_list_sort_name" class="tickets_list_sort">Name</button></th>
                            <th><button id="tickets_list_sort_fromproject" class="tickets_list_sort">From project</button>
                            <th><button id="tickets_list_sort_desc" class="tickets_list_sort">Description</button></th>
                            <th><button id="tickets_list_sort_tl" class="tickets_list_sort">Time limit</button></th>
                            <th><button id="tickets_list_sort_status" class="tickets_list_sort">Status</button></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($TTickets as $TTicket)
                    <tr>
                        <td>#{{ $TTicket->ticket_id }}</td>
                        <td>{{ $TTicket->name }}</td>
                        <td>{{ $TTicket->fromproject }}</td>
                        <td>{{ $TTicket->description }}</td>
                        <td>{{ $TTicket->tlimit }}</td>
                        <td class="{{ $TTicket->status_info['class'] }}">
                            {{ $TTicket->status_info['label'] }}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br /><div>Current projects</div>
            <div class="trash_tickets_wrapper">
                <table class="projects_list">
                    <thead>
                        <tr>
                            <th><button id="projects_list_sort_id" class="projects_list_sort">ID</button></th>
                            <th><button id="projects_list_sort_name" class="projects_list_sort">Name</button></th>
                            <th><button id="projects_list_sort_desc" class="projects_list_sort">Description</button></th>
                            <th><button id="projects_list_sort_owner" class="projects_list_sort">Owner</button></th>
                            <th><button id="projects_list_sort_tl" class="projects_list_sort">Time limit</button></th>
                            <th><button id="projects_list_sort_status" class="projects_list_sort">Status</button></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($TProjects as $TProject)
                    <tr>
                        <td>#P{{ $TProject->project_id }}</td>
                        <td>{{ $TProject->name }}</td>
                        <td>{{ $TProject->description}}</td>
                        <td>{{ $TProject->owner}}</td>
                        <td>{{ $TProject->tlimit }}</td>
                        <td class="{{ $TProject->status_info['class'] }}">
                            {{ $TProject->status_info['label'] }}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>   
    <script src="{{ asset('_dashboard/script.js') }}"></script> 
</body>
</html>
