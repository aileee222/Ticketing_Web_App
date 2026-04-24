<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css?<?php echo time(); ?>" />
    <link rel="stylesheet" href="{{ asset('_calendar/styles.css') }}" />
    <title>My Calendar</title>

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
            <span class="playwrite-regular">My</span> Calendar
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
            <div class="main_container">
                <div class="calendar_container">
                    <div class="header">
                        <div class="center_header">
                            <button id="prev">◀</button>
                            <span id="month_year"></span>
                            <button id="next">▶</button>
                        </div>
                        <button id="openPopup" class="event_show_button">New Event</button>
                    </div>
                    <div class="month">
                        <span>Sun</span>
                        <span>Mon</span>
                        <span>Tue</span>
                        <span>Wed</span>
                        <span>Thr</span>
                        <span>Fri</span>
                        <span>Sat</span>
                    </div>
                    <div class="days"></div>
                </div>
                <div class="events_container">
                    <div class="events_header">
                        <span class="event_title">Events</span>
                    </div>
                    <div id="eventDetails" class="events"></div>
                </div>
            </div>
        </section>
    </div>    
    <section class="popup">
        <div class="in_popup">
            <div class="popup_title">New Event</div><br />
            <form id="submitEventform" class="form_container" action="{{ route('_calendar.store') }}" method="POST">
                @csrf
                <div class="date_container">
                    <div class="startdate_container">
                        <span class="sd">From</span>
                        <input type="datetime-local" class="sd_entry">
                        <div id="sd_error" class="error hide">Please add a start date.</div>
                    </div>
                    <div class="enddate_container">
                        <span class="ed">To</span>
                        <input type="datetime-local" class="ed_entry">
                        <div id="ed_error" class="error hide">Please add a finished date.</div>
                    </div>
                </div>
                <div class="event_name_container">
                    <span class="ticket_name">Name</span>
                    <input type="text" class="ticket_name_entry" placeholder="ticket name">
                    <div id="tktname_error" class="error hide">Please add a finished.</div>
                </div>
                <div class="event_description_container">
                    <span class="description">Description</span>
                    <input class="description_entry" placeholder="description">
                    <div id="description_error" class="error hide">Please add a ticket description.</div>
                </div>
                <button id="submit" class="confirm_button_popup">Confirm</button>
            </form>
        </div>
    </section>
    <script src="{{ asset('_calendar/script.js') }}"></script> 
</body>
</html>
