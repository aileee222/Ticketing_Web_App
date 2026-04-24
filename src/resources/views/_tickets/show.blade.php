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
            @if ($ticket)
                <div class="projet_deadline_container">
                    <div class="project_name_container">
                        <span class="project_name">From Project</span>
                        <span class="project_name_txt">{{ $ticket->fromproject }}</span>
                    </div>
                    <div class="deadline_container">
                        <span class="deadline">Deadline</span>
                        <span class="deadline_txt">{{ $ticket->tlimit }}</span> 
                    </div>
                </div>
                <div class="name_status_container">
                    <div class="ticket_name_container">
                        <span class="ticket_name">Name</span>
                        <span class="ticket_name_txt">{{ $ticket->name }} #{{ $ticket->id }}</span>
                    </div>
                    <div class="status_container">
                        <span class="status_type">Status</span>
                        <span class="{{ $ticket->status_info['class'] }} status_txt">{{ $ticket->status_info['label'] }}</span>
                    </div>
                </div>
                 <div class="description_invoicing_container">
                    <div class="description_container">
                        <span class="description">Description</span>
                        <span class="description_txt">{{ $ticket->description }}</span>
                    </div>
                    <div class="invoicing_container">
                        <span class="invoicing">Invoicing</span>
                        <span class="invoicing_txt">{{ $ticket->invoicing }} €</span>
                    </div>
                </div>
                <div class="comment_container">
                    <span class="comment">Comment</span>
                    <span class="comment_txt">{{ $ticket->comment }}</span>
                </div>
                <div class="info_bar">
                    <button class="favorite">★</button>
                    @if($userStatus !== 'Developper')
                        <button class="edit" onclick="window.location.href = '{{ route('_tickets.edit', $ticket->id) }}';">Edit</button>
                        <button class="new" onclick="window.location.href = '{{ route('_tickets.new') }}';">+</button>
                    @endif    
                    @if($userStatus === 'Manager')
                        <button class="del" onclick="window.location.href = '{{ route('_tickets.remove', $ticket->id) }}';">🗑️</button>
                    @endif
                </div>
            @else
                <p>Ticket not found.</p>
            @endif
            </div>
        </section>
    </div>    
</body>
</html>