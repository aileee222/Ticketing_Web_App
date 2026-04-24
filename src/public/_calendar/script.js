let month = 0;
let year = 2026;
const cellsMap = {};

const monthNames = [
    "January", "February", "March", "April",
    "May", "Juin", "July", "August",
    "September", "October", "November", "Decembrer"
];

let selectedCell = null;

async function getToken() {
    let token = localStorage.getItem('token');
    if(!token) {
        try {
            const res = await fetch('/api/token', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                    }
                });
                const data = await res.json();
                token = data.token;
        } catch (err){
            console.error("Erreur fetch token: ", err);
        }
        localStorage.setItem('token', token);
    }
    return token;
}

function renderCalendar() {
    let curr_day = 1;
    const startDay = new Date(year, month, 1).getDay(); 
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const grid = document.querySelector(".days");

    const monthYear = document.getElementById("month_year");
    monthYear.textContent = `${monthNames[month]} ${year}`;

    grid.innerHTML = "";

    for (let i = 0; i < 42; i++) {
        const cell = document.createElement("button");
        cell.classList.add("day_cell");

        if (i >= startDay && curr_day <= daysInMonth) {
            cell.textContent = curr_day;
            let day = curr_day;

            const pad = n => n.toString().padStart(2, "0");
            const dateStr = `${year}-${pad(month + 1)}-${pad(day)}`;
            cellsMap[dateStr] = cell;

            cell.addEventListener("click", async() => {
                if (selectedCell) {
                    selectedCell.classList.remove("selected");
                }

                cell.classList.add("selected");
                selectedCell = cell;

                let pad = n => n.toString().padStart(2, "0");
                let date = `${year}-${pad(month + 1)}-${pad(day)}`;
                const res = await fetch('/calendar/api/events', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                        'token': `Authorization: Bearer ${getToken()}`
                    },
                    body: "date=" + encodeURIComponent(date)
                });
                const events = await res.json();
                if (res.ok && events.length) {
                    const container = document.getElementById('eventDetails');

                    let html = '';
                    events.forEach(ev => {
                        const start = new Date(ev.start).toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'});
                        const end = new Date(ev.end).toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'});

                        html += `<div class="event">`;
                        html += `<div class="event_header">`;
                        html += `<div class="event_date">${start} - ${end}</div>`;
                        html += `<div class="event_name">${ev.name}</div>`;
                        html += `</div>`;
                        html += `<div class="event_desc">${ev.description}</div>`;
                        html += `</div>`;
                    });

                    container.innerHTML = html;

                    document.querySelectorAll('.event').forEach(color => {
                        color.style.backgroundColor = eventRandomColor();
                    });
                }
                else document.getElementById('eventDetails').innerHTML = "";
            });
            curr_day++;
        }
        grid.appendChild(cell);
    }
}

function eventRandomColor() {
    const colors = ["#e9c0ad", "#f8faa5", "#cbfaa5", "#a5faeb", "#a5c9fa", "#d0baff", "#ffbafa"];
    return colors[Math.floor(Math.random() * colors.length)];
}


function addDotToCell(cell) {
    if (cell.querySelector(".dot")) return;
    const dot = document.createElement("div");
    dot.classList.add("dot");
    cell.appendChild(dot);
}

async function get_events_dot() {
    try {
        Object.values(cellsMap).forEach(c => {
            c.querySelectorAll(".dot").forEach(d => d.remove());
        });
        const res = await fetch('/calendar/api/events_dot', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                'token': `Authorization: Bearer ${getToken()}`
            },
            body: "year=" + encodeURIComponent(year) + "&month=" + encodeURIComponent(month + 1)
        });
        const events = await res.json();
        events.forEach(ev => {
            const cell = cellsMap[ev.date];
            if (cell) addDotToCell(cell, ev);
        });
    } catch (err) {
        console.error("Erreur fetch events du mois:", err);
    }
};

function checkForm() {
    let error = 0;

    const date = document.querySelector('.sd_entry');
    const inputDate = new Date(date.value);

    const date_error = document.querySelector('#sd_error');
    const now = new Date();    

    if(inputDate <= now || date.value == "") {
        date_error.classList.remove('hide');
        error++;
    }
    else date_error.classList.add('hide');

    const date2 = document.querySelector('.ed_entry');
    const inputDate2 = new Date(date2.value);

    const date_error2 = document.querySelector('#ed_error');
    
    if(inputDate2 <= now || date2.value == "") {
        date_error2.classList.remove('hide');
        error++;
    }
    else date_error2.classList.add('hide');

    const name = document.querySelector('.ticket_name_entry');
    const name_error = document.querySelector('#tktname_error');
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

    return error;
}

document.addEventListener("DOMContentLoaded", () => {
    renderCalendar();
    get_events_dot();
});

document.getElementById("prev").addEventListener("click", () => {
    if (month <= 0) {
        month = 11;
        year--;
    } 
    else month--;
    renderCalendar();
    get_events_dot();
});

document.getElementById("next").addEventListener("click", () => {
    if (month >= 11) {
        month = 0;
        year++;
    }
    else month++;
    renderCalendar();
    get_events_dot();
});

const openBtn = document.getElementById('openPopup');
const popup = document.querySelector('.popup');
const form = document.getElementById('submitEventform');

openBtn.addEventListener('click', () => {
    popup.classList.add('active');
});

popup.addEventListener('click', (e) => {
    if (e.target === popup) {
        popup.classList.remove('active');
    }
});

form.addEventListener('submit', async(e) => {
    e.preventDefault(); 
    let errors = checkForm();
    const start = document.querySelector('.sd_entry').value;
    const end = document.querySelector('.ed_entry').value;
    const name = document.querySelector('.ticket_name_entry').value.trim();
    const description = document.querySelector('.description_entry').value.trim();

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    if (errors === 0) {
        const res = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'token': `Authorization: Bearer ${getToken()}`
                },
                body: JSON.stringify({name, description, start, end})
            });
        const data = await res.json();
        if (res.ok && data.success) {
            window.location.href = '/calendar';
        } else {
            console.log(data);
        }
        popup.classList.remove('active');
        form.reset();
    }
});