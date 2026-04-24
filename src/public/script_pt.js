const tickets_search = document.querySelector('.ticket_title_container .title_container_input');
let are_all_tickets_displayed = true;
const projects_search = document.querySelector('.project_title_container .title_container_input');
let are_all_projects_displayed = true;

if(tickets_search) {
    tickets_search.addEventListener('keyup', () => {
        if(tickets_search.value == "" && are_all_tickets_displayed) {}
        else if (tickets_search.value == "" && !are_all_tickets_displayed) {
            const ticket_card = document.querySelectorAll('.tickets_container .ticket_card');
            ticket_card.forEach(ticket => {
                ticket.classList.remove('hide');
            });
            are_all_tickets_displayed = true;
        }
        else if (tickets_search.value != "") {
            const ticket_card = document.querySelectorAll('.tickets_container .ticket_card');
            ticket_card.forEach(ticket => {
                if(ticket.children[0].innerHTML.toLowerCase().includes(tickets_search.value.toLowerCase())) ticket.classList.remove('hide');
                else ticket.classList.add('hide');
            });
            are_all_tickets_displayed = false;
        }
    });
}
if(projects_search) {
    projects_search.addEventListener('keyup', () => {
        if(projects_search.value == "" && are_all_projects_displayed) {}
        else if (projects_search.value == "" && !are_all_projects_displayed) {
            const projects_card = document.querySelectorAll('.projects_container .project_card');
            projects_card.forEach(project => {
                project.classList.remove('hide');
            });
            are_all_projects_displayed = true;
        }
        else if (projects_search.value != "") {
            const projects_card = document.querySelectorAll('.projects_container .project_card');
            projects_card.forEach(project => {
                if(project.children[0].innerHTML.toLowerCase().includes(projects_search.value.toLowerCase())) project.classList.remove('hide');
                else project.classList.add('hide');
            });
            are_all_projects_displayed = false;
        }
    });
}


