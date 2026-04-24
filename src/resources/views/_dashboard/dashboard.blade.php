<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+J+Guides:ital@0;1&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Delius&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <header>
        <h1>
            <span class="playwrite-regular">My</span> Dashboard
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
            <div>Current tickets status</div>
            <table class="blockcell">
                <tbody>
                    <tr>
                        <td class="blockcell0">
                            <a href="{{ route('dashboard.status.not_started') }}" class="enormous_nb">{{ $bloc_infos_ticket[0] }}</a>
                            <span class="little_letters">Not started</span>
                        </td>
                        <td class="blockcell1">
                            <a href="{{ route('dashboard.status.low') }}" class="enormous_nb">{{ $bloc_infos_ticket[1] }}</a>
                            <span class="little_letters">Low</span>
                        </td>
                        <td class="blockcell2">
                            <a href="{{ route('dashboard.status.medium') }}" class="enormous_nb">{{ $bloc_infos_ticket[2] }}</a>
                            <span class="little_letters">Medium</span>
                        </td>
                        <td class="blockcell3">
                            <a href="{{ route('dashboard.status.high') }}" class="enormous_nb">{{ $bloc_infos_ticket[3] }}</a>
                            <span class="little_letters">High</span>
                        </td>
                        <td class="blockcell4">
                            <a href="{{ route('dashboard.status.critical') }}" class="enormous_nb">{{ $bloc_infos_ticket[4] }}</a>
                            <span class="little_letters">Critical</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="circles">
                <tbody>
                    <tr>
                        <td class="cell">
                            <h2 class="title">To be finished</h2>
                            <div class="circle" id="circle_tab1">
                                <div class="circle_inner">
                                    <span class="circle_nb">{{ $bloc_infos_ticket[4] }}</span>
                                </div>
                            </div>
                            <div class="legend_container">
                                <div class="legend_item">
                                    <span class="legend_txt_red"></span>
                                    <span class="legend_txt">Critical</span>
                                </div>  
                            </div>
                        </td>
                        <td class="cell">
                            <h2 class="title">Total</h2>
                            <div class="circle" id="circle_tab2">
                                <div class="circle_inner">
                                    <span class="circle_nb">{{ $ticketsCount }}</span>
                                </div>
                            </div>
                            <div class="legend_container">
                                <div class="legend_item">
                                    <span class="legend_txt_blue"></span>
                                    <span class="legend_txt">Not Started</span>
                                </div>  
                                <div class="legend_item">
                                    <span class="legend_txt_green"></span>
                                    <span class="legend_txt">Low</span>
                                </div>
                                <div class="legend_item">
                                    <span class="legend_txt_yellow"></span>
                                    <span class="legend_txt">Medium</span>
                                </div>
                                <div class="legend_item">
                                    <span class="legend_txt_orange"></span>
                                    <span class="legend_txt">high</span>
                                </div>
                                <div class="legend_item">
                                    <span class="legend_txt_red"></span>
                                    <span class="legend_txt">Critical</span>
                                </div>   
                            </div>  
                        </td>
                        <td class="cell">
                        <h2 class="title">Tickets</h2>
                            <div class="tickets_list_wrapper">
                                <table class="tickets_list">
                                    <thead>
                                        <tr>
                                            <th><button id="tickets_list_sort_id" class="tickets_list_sort">ID</button></th>
                                            <th><button id="tickets_list_sort_name" class="tickets_list_sort">Name</button></th>
                                            <th><button id="tickets_list_sort_fromproject" class="tickets_list_sort">From project</button></th>                                   
                                            <th><button id="tickets_list_sort_desc" class="tickets_list_sort">Description</button></th>
                                            <th><button id="tickets_list_sort_tl" class="tickets_list_sort">Time limit</button></th>
                                            <th><button id="tickets_list_sort_status" class="tickets_list_sort">Status</button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($tickets as $ticket)
                                    <tr>
                                        <td>#{{ $ticket->id }}</td>
                                        <td>{{ $ticket->name }}</td>
                                        <td>{{ $ticket->fromproject }}</td>
                                        <td>{{ $ticket->description }}</td>
                                        <td>{{ $ticket->tlimit }}</td>
                                        <td class="{{ $ticket->status_info['class'] }}">
                                            {{ $ticket->status_info['label'] }}
                                        </td>
                                    @endforeach
                                    </tbody>
                                </table> 
                            </div>                        
                        </td>
                    </tr>
                    <tr>
                        <td class="cell">
                            <h2 class="title">To be finished</h2>
                            <div class="circle" id="circle_tab3">
                                <div class="circle_inner">
                                    <span class="circle_nb">{{ $bloc_infos_project[0] }}</span>
                                </div>
                            </div>
                            <div class="legend_container">
                                <div class="legend_item">
                                    <span class="legend_txt_red"></span>
                                    <span class="legend_txt">Critical</span>
                                </div>  
                            </div>
                        </td>
                        <td class="cell">
                            <h2 class="title">Total</h2>
                            <div class="circle" id="circle_tab4">
                                <div class="circle_inner">
                                    <span class="circle_nb">{{ $projectsCount }}</span>
                                </div>
                            </div>
                            <div class="legend_container">
                                <div class="legend_item">
                                    <span class="legend_txt_blue"></span>
                                    <span class="legend_txt">Not Started</span>
                                </div>  
                                <div class="legend_item">
                                    <span class="legend_txt_green"></span>
                                    <span class="legend_txt">Low</span>
                                </div>
                                <div class="legend_item">
                                    <span class="legend_txt_yellow"></span>
                                    <span class="legend_txt">Medium</span>
                                </div>
                                <div class="legend_item">
                                    <span class="legend_txt_orange"></span>
                                    <span class="legend_txt">high</span>
                                </div>
                                <div class="legend_item">
                                    <span class="legend_txt_red"></span>
                                    <span class="legend_txt">Critical</span>
                                </div>   
                            </div> 
                        </td>
                        <td class="cell">
                            <h2 class="title">Projects</h2>
                            <div class="projects_list_wrapper">
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
                                    @foreach ($projects as $project)
                                    <tr>
                                        <td>#P{{ $project->id }}</td>
                                        <td>{{ $project->name }}</td>
                                        <td>{{ $project->description }}</td>
                                        <td>{{ $project->owner }}</td>
                                        <td>{{ $project->tlimit }}</td>
                                        <td class="{{ $project->status_info['class'] }}">
                                            {{ $project->status_info['label'] }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            </div>                          
                        </td>
                      </tr>
                  </tbody>
            </table>
        </section>
    </div> 
    <script src="{{ asset('_dashboard/script.js') }}"></script>   
</body>
</html>
