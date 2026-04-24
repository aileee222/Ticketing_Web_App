<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('_profile/styles.css') }}" />
    <title>My Profile</title>

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
            <span class="playwrite-regular">My</span> Profile
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
            <div class="info_container">
                <div class="left_container">
                    <img src="{{ asset('_profile/avatar.png') }}" class="img_profile"> 
                    <div class="name_container">
                        <span class="firstname">{{ $user->firstname }}&nbsp;</span>
                        <span class="lastname">{{ $user->lastname }}</span>
                    </div>
                    <span class="email">{{ $user->mail }}</span>
                    <button id="submit" type="submit" form="form_submit" class="edit_profil">Confirm</button>
                </div>
                <form id="form_submit" class="middle_container" action="{{ route('_profile.update') }}" method="POST">
                    @csrf
                    <span class="start_middle">About</span>
                    <div class="name_container">
                        <div class="firstname_container">
                            <span class="title">Firstname</span>
                            <input type="text" class="firstname_entry" placeholder="{{ $user->firstname }}">
                            <div id="firstname_error" class="error hide">Please enter your firstname.</div>
                        </div>
                        <div class="lastname_container">
                            <span class="title">Lastname</span>
                            <input type="text" class="lastname_entry" placeholder="{{ $user->lastname }}">
                            <div id="lastname_error" class="error hide">Please enter your lastname.</div>
                        </div> 
                    </div>
                    <div class="birthday_container">
                        <span class="title">Birthday</span>
                        <input type="date" class="birthday_entry" placeholder="{{ $user->birthday }}">
                        <div id="date_error" class="error hide">Please enter your birthdate.</div>
                    </div>
                    <div class="phonenumber_container">
                        <span class="title">Phone Number</span>
                        <input type="tel" pattern="[0-9]{2,3}[0-9]{8}" class="phone_entry" placeholder="{{ $user->tel }}">
                        <div id="phone_error" class="error hide">Please enter a correct phone number.</div>
                    </div>
                    <div class="location_container">
                        <span class="title">Location</span>
                        <input type="text" class="location_entry" placeholder="{{ $user->location }}">
                        <div id="location_error" class="error hide">Please enter your location.</div>
                    </div>
                    <div class="education_container">
                        <span class="title">Education</span>
                        <input type="text" class="education_entry" placeholder="{{ $user->education }}">
                        <div id="education_error" class="error hide">Please enter your education.</div>
                    </div>
                    <div class="status_container">
                        <span class="title">Status</span>
                        <span class="txt">{{ $user->status['label'] }}</span>
                    </div>
                    <div class="prj_container">
                        <span class="title">Total Projects:</span>
                        <span class="txt">{{ $tp }}</span>
                    </div>
                    <div class="tkt_container">
                        <span class="title">Total Tickets:</span>
                        <span class="txt">{{ $tt }}</span>
                    </div>
                </form>
                <div class="right_container">
                    <span class="start_middle">Software Information</span>
                    <div class="credit_container">
                        <span class="title">credit</span>
                        <span class="txt">credit</span>
                    </div>
                    <div class="version_container">
                        <span class="title">Version</span>
                        <span class="txt">version</span>
                    </div>
                    <div class="maj_container">
                        <span class="title">Last Update</span>
                        <span class="txt">last update</span>
                    </div>
                </div>
            </div>
        </section>
    </div>   
    <script src="{{ asset('_profile/script.js') }}"></script> 
</body>
</html>