<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('styles.css') }}" />
    <title>My Tickets</title>

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
            <span class="playwrite-regular">My</span> Tickets
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
            <div class="ticket_title_container">
                <div>Current Tickets</div><br />
                <input class="title_container_input" type="text" placeholder="Enter ticket name">
            </div>
            <div class="tickets_container">
                @foreach ($tickets as $ticket)
                    <a href="{{ route('_tickets.show', $ticket->id) }}" class="ticket_card">
                            <h3>{{ $ticket->name }} #{{ $ticket->id }}</h3>
                            <p>{{ $ticket->fromproject }}</p>
                            <p>{{ $ticket->description }}</p>
                            <p>Duration: {{ $ticket->tlimit }} | Status: 
                                <span class="{{ $ticket->status_info['class'] }} status_txt">{{ $ticket->status_info['label'] }}</span>
                            </p>
                    </a>
                @endforeach
            </div>   
            @if($userStatus !== 'Developper') 
                <button class="confirm_button" onclick="window.location.href = '{{ route('_tickets.new') }}';">+</button>
            @endif
        </section>
    </div>   
    <script src="{{ asset('script_pt.js') }}"></script>
</body>
</html>
