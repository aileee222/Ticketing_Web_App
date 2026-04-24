function checkForm(choice) { //choice = 0 ==> ticket
    let error = 0;
    if(choice == 1) {
        const owner = document.querySelector('.owner_name_entry');
        const owner_error = document.querySelector('#owner_error');
        if(owner.value == "") {
            owner_error.classList.remove('hide');
            error++;
        }
        else owner_error.classList.add('hide');
    }
    if(choice == 0) {
        const txtname = document.querySelector('.ticket_name_entry');
        const txtname_error = document.querySelector('#tktname_error');
        if(txtname.value == "") {
            txtname_error.classList.remove('hide');
            error++;
        }
        else txtname_error.classList.add('hide');
    }

    const date = document.querySelector('.deadline_entry');
    const inputDate = new Date(date.value);

    const date_error = document.querySelector('#deadline_error');
    const now = new Date();    

    if(inputDate <= now || date.value == "") {
        date_error.classList.remove('hide');
        error++;
    }
    else date_error.classList.add('hide');

    const name = document.querySelector('.project_name_entry');
    const name_error = document.querySelector('#name_error');
    if(name.value == "") {
        name_error.classList.remove('hide');
        error++;
    }
    else name_error.classList.add('hide');
    

    const desc = document.querySelector('.description_entry');
    const desc_error = document.querySelector('#description_error');
    if(desc.value == "") {
        desc_error.classList.remove('hide');
        error++;
    }
    else desc_error.classList.add('hide');

    const comment = document.querySelector('.comment_entry');
    const comment_error = document.querySelector('#comment_error');
    if(comment.value == "") {
        comment_error.classList.remove('hide');
        error++;
    }
    else comment_error.classList.add('hide');

    const status = document.querySelector('.status_entry');
    const status_error = document.querySelector('#status_error');
    if(status.value == "") {
        status_error.classList.remove('hide');
        error++;
    }
    else status_error.classList.add('hide');

    return error;
}

function get_status_id(status) {
    switch(status) {
    case "Not Started":
        return 0;
        break;
    case "Low":
        return 1;
        break;    
    case "Medium":
        return 2;
        break;
    case "High":
        return 3;
        break;
    case "Critical":
        return 4;
        break;            
    default:
        return 4;
    } 
}

const submit_project = document.querySelector('#submitPrjform');
if(submit_project) {
    submit_project.addEventListener('submit', async (e) => {
        e.preventDefault();
        let errors = checkForm(1);
        const owner = document.querySelector('.owner_name_entry').value.trim();
        const tlimit = document.querySelector('.deadline_entry').value;
        const name = document.querySelector('.project_name_entry').value.trim();
        const description = document.querySelector('.description_entry').value.trim();
        const comment = document.querySelector('.comment_entry').value.trim();
        
        const status_string = document.querySelector('.status_entry').value.trim();
        const status = get_status_id(status_string);
        
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        if(errors === 0) {
            const res = await fetch(submit_project.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({name, description, owner, tlimit, comment, status})
            });
            const data = await res.json();
            if (res.ok && data.success) {
                window.location.href = '../projects';
            } else {
                console.log(data);
            }
        }
    });
}

const submit_ticket = document.querySelector('#submitTktform');
if(submit_ticket) {
    submit_ticket.addEventListener("submit", async(event) => {
        event.preventDefault();
        let errors = checkForm(0);
        const fromproject = document.querySelector('.project_name_entry').value;
        const tlimit = document.querySelector('.deadline_entry').value;
        const name = document.querySelector('.ticket_name_entry').value.trim();
        const description = document.querySelector('.description_entry').value.trim();
        const comment = document.querySelector('.comment_entry').value.trim();
        const status_string = document.querySelector('.status_entry').value.trim();
        const status = get_status_id(status_string);
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if(errors === 0) {
            const res = await fetch(submit_ticket.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({name, description, fromproject, tlimit, comment, status})
            });
            const data = await res.json();
            if (res.ok && data.success) {
                window.location.href = '../tickets';
            } else {
                console.log(data);
            }
        }
    });
}