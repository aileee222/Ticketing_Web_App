const filter_id = document.querySelector('#tickets_list_sort_id');
const filters_txt1 = document.querySelector('#tickets_list_sort_name');
const filters_txt2 = document.querySelector('#tickets_list_sort_fromproject');
const filters_txt3 = document.querySelector('#tickets_list_sort_desc');
const filter_tl = document.querySelector('#tickets_list_sort_tl');

let tkt_filter_id_asc = true;
let filter_name_asc = true;
let filter_desc_asc = true;
let filter_fromproject_asc = true;
let tkt_filter_tl_asc = true;
let tkt_filter_status_asc = true;
let filter_owner_asc = true;


function timeToMinutes(time) {
    const num = parseInt(time);
    const unit = time.slice(-1);
    switch(unit) {
        case 'm': return num;
        case 'h': return num * 60;
        case 'd': return num * 60 * 24;
        case 'w': return num * 60 * 24 * 7;
        case 'y': return num * 60 * 24 * 365;
        default: return 0;
    }
}

// sort_select:
// 0: id
// 1: name, desc, from project
// 2: owner
// 3: tl
// 4: status
function tab_filters(table, index_col, sort_select, order) {
    const tbody = document.querySelector(`${table} tbody`);
    const rows = Array.from(tbody.querySelectorAll("tr"));

    if(sort_select === 0) {   
            rows.sort((a, b) => {
                let skip_letters = 1;
                if(table != ".tickets_list") skip_letters = 2;

                const idA = Number(a.children[index_col].textContent.slice(skip_letters));
                const idB = Number(b.children[index_col].textContent.slice(skip_letters)); //slice 0 ===> ", slice 1 ===> #
                return order ? idA - idB : idB - idA;
            });
    }
    else if(sort_select === 1) {
        rows.sort((a, b) => {
            const nameA = a.children[index_col].textContent.trim();
            const nameB = b.children[index_col].textContent.trim();
            return order ? nameA.localeCompare(nameB, 'en', { sensitivity: "base" }) : nameB.localeCompare(nameA, 'en', { sensitivity: "base" });
        });
    }
    else if(sort_select === 2) {
        rows.sort((a, b) => {
            const ownerA = a.children[index_col].textContent.trim().split(" ").slice(-1)[0];
            const ownerB = b.children[index_col].textContent.trim().split(" ").slice(-1)[0];        
            return order ? ownerA.localeCompare(ownerB, 'en', { sensitivity: "base" }) : ownerB.localeCompare(ownerA, 'en', { sensitivity: "base" });
        });
    }
    else {
        rows.sort((a, b) => {
            const tlA = a.children[index_col].textContent.trim();
            const tlB = b.children[index_col].textContent.trim();
            const tlA_res = timeToMinutes(tlA);
            const tlB_res = timeToMinutes(tlB);
            return order ? tlA_res - tlB_res : tlB_res - tlA_res;
        });
    }
    rows.forEach(i => tbody.appendChild(i));
}


filter_id.addEventListener("click", () => {
    tab_filters(".tickets_list", 0, 0, tkt_filter_id_asc);
    tkt_filter_id_asc = !tkt_filter_id_asc;
});

filters_txt1.addEventListener("click", () => {
    tab_filters(".tickets_list", 1, 1, filter_name_asc);
    filter_name_asc = !filter_name_asc;
});
filters_txt2.addEventListener("click", () => {
    tab_filters(".tickets_list", 2, 1, filter_fromproject_asc);
    filter_fromproject_asc = !filter_fromproject_asc;
});

filters_txt3.addEventListener("click", () => {
    tab_filters(".tickets_list", 2, 1, filter_desc_asc);
    filter_desc_asc = !filter_desc_asc;
});

filter_tl.addEventListener("click", () => {
    tab_filters(".tickets_list", 4, 3, tkt_filter_tl_asc);
    tkt_filter_tl_asc = !tkt_filter_tl_asc;
});