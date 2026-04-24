const filter_id = document.querySelectorAll('#tickets_list_sort_id, #projects_list_sort_id');
const filters_txt1 = document.querySelectorAll('#tickets_list_sort_name, #projects_list_sort_name');
const filters_txt2 = document.querySelector('#tickets_list_sort_fromproject');
const filters_txt3 = document.querySelectorAll('#tickets_list_sort_desc, #projects_list_sort_desc');
const filter_tl = document.querySelectorAll('#tickets_list_sort_tl, #projects_list_sort_tl');
const filter_status = document.querySelectorAll('#tickets_list_sort_status, #projects_list_sort_status');
const filter_owner = document.querySelector('#projects_list_sort_owner');

let filter_id_asc = true;
let filter_name_asc = true;
let filter_desc_asc = true;
let filter_fromProject_asc = true;
let filter_tl_asc = true;
let filter_status_asc = true;
let filter_owner_asc = true;


const enormous_nb = document.querySelectorAll('.enormous_nb');
enormous_nb.forEach((num, i) => {
    if (Number(num.innerText) !== 0) {
        let count = 0;
        let target = num.innerText;
        num.innerText = 0;
        const interval = setInterval(() => {
            count++;
            num.innerText = count;
            if (count >= target) {
                clearInterval(interval);
            }
        }, 10); //tous les 10ms
    }
});

// sort_select:
// 0: id
// 1: name, desc, form project
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
    else if(sort_select === 3) {
        rows.sort((a, b) => {
            const tlA = a.children[index_col].textContent.trim();
            const tlB = b.children[index_col].textContent.trim();
            
            const dateA = new Date(tlA);
            const dateB = new Date(tlB);

            return order ? (dateA - dateB) : (dateB - dateA);
        });
    }
    else {
        rows.sort((a, b) => {
            const statusA = a.children[index_col].textContent.trim();
            const statusB = b.children[index_col].textContent.trim();
            const order_list = {"Not Started": 1, "Low": 2, "Medium": 3, "High": 4, "Critical": 5};
            
            return order ? order_list[statusA] - order_list[statusB] : order_list[statusB] - order_list[statusA];
        });
    }
    rows.forEach(i => tbody.appendChild(i));
}


filter_id.forEach((btn, i) => {
    btn.addEventListener("click", () => {
        if(i === 0) tab_filters(".tickets_list", 0, 0, filter_id_asc);
        else tab_filters(".projects_list", 0, 0, filter_id_asc);
        filter_id_asc = !filter_id_asc;
    });
});
filters_txt1.forEach((btn, i) => {
    btn.addEventListener("click", () => {
        if(i === 0) tab_filters(".tickets_list", 1, 1, filter_name_asc);
        else tab_filters(".projects_list", 1, 1, filter_name_asc);
        filter_name_asc = !filter_name_asc;
    });
});
filters_txt2.addEventListener("click", () => {
    tab_filters(".tickets_list", 2, 1, filter_fromProject_asc);
    filter_fromProject_asc = !filter_fromProject_asc;
    
});
filters_txt3.forEach((btn, i) => {
    btn.addEventListener("click", () => {
        if(i === 0) tab_filters(".tickets_list", 2, 1, filter_desc_asc);
        else tab_filters(".projects_list", 2, 1, filter_desc_asc);
       filter_desc_asc = !filter_desc_asc;
    });
});
filter_tl.forEach((btn, i) => {
    btn.addEventListener("click", () => {
        if(i === 0) tab_filters(".tickets_list", 4, 3, filter_tl_asc);
        else tab_filters(".projects_list", 4, 3, filter_tl_asc);
        filter_tl_asc = !filter_tl_asc;
    });
});
filter_status.forEach((btn, i) => {
    btn.addEventListener("click", () => {
        if(i === 0) tab_filters(".tickets_list", 5, 4, filter_status_asc);
        else tab_filters(".projects_list", 5, 4, filter_status_asc);
        filter_status_asc = !filter_status_asc;
    });
});
filter_owner.addEventListener("click", () => {
    tab_filters(".projects_list", 3, 2, filter_owner_asc);
    filter_owner_asc = !filter_owner_asc;
});