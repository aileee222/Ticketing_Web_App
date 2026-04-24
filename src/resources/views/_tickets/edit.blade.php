<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('_projects/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('styles.css') }}" />
    <title>My Ticket</title>

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
            <span class="playwrite-regular">My</span> Ticket
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
            <div>Current Ticket</div><br />
            <div class="form_container">
            @if($ticket)
            <form id="submit_ticket" action="{{ route('_tickets.update', $ticket->id) }}" method="POST">
                <div class="projet_deadline_container">
                    <div class="project_name_container">
                        <span class="project_name">From Project</span>
                        <input type="text" class="project_name_txt" value="{{ $ticket->fromproject }}">
                        <div id="project_name_error" class="error hide">Please enter a project.</div>
                    </div>
                    <div class="deadline_container">
                        <span class="deadline">Deadline</span>
                        <input type="text" class="deadline_txt" value="{{ $ticket->tlimit }}">
                        <div id="deadline_error" class="error hide">Please enter a project.</div>
                    </div>
                </div>
                <div class="name_status_container">
                    <div class="ticket_name_container">
                        <span class="ticket_name">Name</span>
                        <input type="text" class="ticket_name_txt" value="{{ $ticket->name }}">
                        <div id="ticket_name_error" class="error hide">Please enter a project.</div>
                    </div>
                    <div class="status_container">
                        <span class="status_type">Status</span>
                        <input type="text" class="status_txt_edit" value="{{ $ticket->status_info['label'] }}">
                        <div id="status_error" class="error hide">Please enter a project.</div>
                    </div>
                </div>
                 <div class="description_invoicing_container">
                    <div class="description_container">
                        <span class="description">Description</span>
                        <input type="text" class="description_txt" value="{{ $ticket->description }}">
                        <div id="description_error" class="error hide">Please enter a project.</div>
                    </div>
                    <div class="invoicing_container">
                        <span class="invoicing">Invoicing</span>
                        <span class="invoicing_txt">{{ $ticket->invoicing }} €</span>
                    </div>
                </div>
                <div class="comment_container">
                    <span class="comment">Comment</span>
                    <input type="text" class="comment_txt" value="{{ $ticket->comment }}">
                    <div id="comment_error" class="error hide">Please enter a project.</div>
                </div>
                <div class="info_bar">
                    <button class="edit" onclick="window.location.href = '{{ route('_tickets.edit', $ticket->id) }}';">Edit</button>
                    <button class="favorite">★</button>
                    <button class="new" onclick="window.location.href = '{{ route('_tickets.new') }}';">+</button>
                    @if($userStatus === 'Manager')
                        <button class="del" onclick="window.location.href = '{{ route('_tickets.remove', $ticket->id) }}';">🗑️</button>
                    @endif
                    <button id="submit" type="submit" form="submit_ticket" class="edit">Done</button>
                </div>
            </form>
            @else
                <p>Ticket not found.</p>
            @endif
            </div>
        </section>
    </div>    
    <script src="{{ asset('_projects/edit.js') }}"></script>
</body>
</html>