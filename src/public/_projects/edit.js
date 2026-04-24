const submit_project = document.querySelector('#submit_project');
if(submit_project) {
    submit_project.addEventListener('submit', async (event) => {
        event.preventDefault();
        const owner = document.querySelector('.owner_name_txt').value.trim() || "";
        const tlimit = document.querySelector('.deadline_txt').value.trim() || "";
        const name = document.querySelector('.project_name_txt').value.trim() || "";
        const status = document.querySelector('.status_txt_edit').value.trim() || "";
        const description = document.querySelector('.description_txt').value.trim() || "";
        const comment = document.querySelector('.comment_txt').value.trim() || "";

        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const res = await fetch(submit_project.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({name, owner, description, tlimit, comment, status})
        });
        const data = await res.json();
        if (res.ok && data.success) {
            window.location.href = '../';
        } else {
            console.log(data);
        }
    });
}

const submit_ticket = document.querySelector('#submit_ticket');
if(submit_ticket) {
    submit_ticket.addEventListener('submit', async (event) => {
        event.preventDefault();
        const fromproject = document.querySelector('.project_name_txt').value.trim() || "";
        const tlimit = document.querySelector('.deadline_txt').value.trim() || "";
        const name = document.querySelector('.ticket_name_txt').value.trim() || "";
        const status = document.querySelector('.status_txt_edit').value.trim() || "";
        const description = document.querySelector('.description_txt').value.trim() || "";
        const comment = document.querySelector('.comment_txt').value.trim() || "";

        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        console.log(token);
        console.log(submit_ticket.action);
        const res = await fetch(submit_ticket.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({name, fromproject, description, tlimit, comment, status})
        });
        const data = await res.json();
        if (res.ok && data.success) {
            window.location.href = '../';
        } else {
            console.log(data);
        }
        console.log(token);
    });
}