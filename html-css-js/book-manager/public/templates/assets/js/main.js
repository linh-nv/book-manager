function menu() {
    const menuClick = document.getElementById('menu-click');
    const sidebarMenu = document.querySelector('.sidebar-menu');
    const logo = document.querySelector('.logo');
    const topBar = document.querySelector('.top-bar');
    const sidebarItems = document.querySelectorAll('.sidebar-menu .iteam-text span');

    const currentWidth = sidebarMenu.offsetWidth;
    if (currentWidth === 240) {
        sidebarMenu.style.width = '100px';
        logo.style.opacity = 0;
        topBar.style.width = 'calc(100vw - 100px)';

        sidebarItems.forEach(function(span) {
            span.style.opacity = '0';
            span.style.pointerEvents = 'none';
        });
    } else {
        sidebarMenu.style.width = '240px';
        logo.style.opacity = 1;
        topBar.style.width = 'calc(100vw - 240px)';

        sidebarItems.forEach(function(span) {
            span.style.opacity = '';
            span.style.pointerEvents = '';
        });
    }
}
function typePage(type) {
    const sidebarItems = document.querySelectorAll('.sidebar-item');

    sidebarItems.forEach(function(item) {
        const sidebarItemText = item.querySelector('.iteam-text span').textContent;

        if (type === sidebarItemText) {
            item.classList.add('active-btn');
        }
    });
}

let book = [
    {
        "id": 1,
        "title": "The Great Gatsby",
        "image": "https://example.com/the_great_gatsby.jpg",
        "author": "F. Scott Fitzgerald",
        "publisher": "Scribner",
        "price": 12.99,
        "category": 1 // Fiction
    },
    {
        "id": 2,
        "title": "To Kill a Mockingbird",
        "image": "https://example.com/to_kill_a_mockingbird.jpg",
        "author": "Harper Lee",
        "publisher": "J. B. Lippincott & Co.",
        "price": 10.50,
        "category": 2 // Classic
    },
    {
        "id": 3,
        "title": "1984",
        "image": "https://example.com/1984.jpg",
        "author": "George Orwell",
        "publisher": "Secker & Warburg",
        "price": 9.99,
        "category": 3 // Science Fiction
    },
    {
        "id": 4,
        "title": "To Kill a Mockingbird",
        "image": "https://example.com/to_kill_a_mockingbird.jpg",
        "author": "Harper Leeasdas",
        "publisher": "J. B. Lippincott & Co.",
        "price": 10.50,
        "category": 2 // Classic
    },
    {
        "id": 5,
        "title": "1984",
        "image": "https://example.com/1984.jpg",
        "author": "saffas safsf",
        "publisher": "Secker & Warburg",
        "price": 9.99,
        "category": 3 // Science Fiction
    }
    ,
    {
        "id": 6,
        "title": "1984",
        "image": "https://example.com/1984.jpg",
        "author": "George Orwell",
        "publisher": "Secker & Warburg",
        "price": 9.99,
        "category": 3 // Science Fiction
    },
    {
        "id": 7,
        "title": "To Kill a Mockingbird",
        "image": "https://example.com/to_kill_a_mockingbird.jpg",
        "author": "Harper Leeasdas",
        "publisher": "J. B. Lippincott & Co.",
        "price": 10.50,
        "category": 2 // Classic
    },
    {
        "id": 8,
        "title": "1984",
        "image": "https://example.com/1984.jpg",
        "author": "saffas safsf",
        "publisher": "Secker & Warburg",
        "price": 9.99,
        "category": 3 // Science Fiction
    }
]
let category = [
    {
        "id": 1,
        "title": "Fiction"
    },
    {
        "id": 2,
        "title": "Classic"
    },
    {
        "id": 3,
        "title": "Fantasy"
    },
    {
        "id": 4,
        "title": "Science Fiction"
    },
    {
        "id": 5,
        "title": "Mystery"
    },
    {
        "id": 6,
        "title": "Romance"
    },
    {
        "id": 7,
        "title": "Thriller"
    },
    {
        "id": 8,
        "title": "Horror"
    },
    {
        "id": 9,
        "title": "Biography"
    },
    {
        "id": 10,
        "title": "History"
    },
    {
        "id": 11,
        "title": "Self-Help"
    },
    {
        "id": 12,
        "title": "Cooking"
    },
    {
        "id": 13,
        "title": "Travel"
    },
    {
        "id": 14,
        "title": "Poetry"
    },
    {
        "id": 15,
        "title": "Art"
    },
    {
        "id": 16,
        "title": "Music"
    },
    {
        "id": 17,
        "title": "Film"
    },
    {
        "id": 18,
        "title": "Business"
    },
    {
        "id": 19,
        "title": "Finance"
    },
    {
        "id": 20,
        "title": "Technology"
    }
];
/*
*
* ============= Search ===============
*
*/
function search() {
    let searchValue = document.getElementById('search').value.trim().toLowerCase();
    let searchResult = document.getElementById('search-result');

    if (searchValue) {
        let list_category = "";
        for (let i = 0; i < category.length; i++) {
            const title = category[i].title.toLowerCase(); 

            if (title.indexOf(searchValue) !== -1) {
                list_category += `
                <li>ID category: ${category[i].id}<br/> Title Category: ${category[i].title} </li>`;
            }
        }
        for (let i = 0; i < book.length; i++) {
            const title = book[i].title.toLowerCase(); 

            if (title.indexOf(searchValue) !== -1) {
                list_category += `
                <li>ID book: ${book[i].id}<br/> Title Book: ${book[i].title} </li>`;
            }
        }
        searchResult.innerHTML = list_category ? list_category : "<p>No matching categories, books found.</p>";
        searchResult.style.display = "block";
    } else {
        searchResult.style.display = "none";
    }
}
function getDataFromName(name){
    switch(name) {
        case 'book':
            return book;
        case 'category':
            return category;
        default:
            return null;
    }
}

/*
*
* ============= paginate ===============
*
*/
const itemsPerPage = 3; // Số phần tử mỗi trang
let currentPage = 1; // Mặc định trang hiện tại

function paginate(data, page) {
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    return data.slice(startIndex, endIndex);
}
function prevPages(name) {
    let data = getDataFromName(name);
    if (currentPage > 1) {
        currentPage--;
        showData(data, name)
    }
}

function nextPages(name) {
    let data = getDataFromName(name);
    let totalPage = Math.ceil(data.length / itemsPerPage);
    if (currentPage < totalPage) {
        currentPage++;
        showData(data, name)
    }
}

function goToPages(page, name) {
    currentPage = page;

    let data = getDataFromName(name);
    showData(data, name);
}
function renderPaginationData(data, name) {
    let totalPage = Math.ceil(data.length / itemsPerPage);

    let paginationHTML = `
                <div id="prev-page" onclick="prevPages('${name}')">
                    <img src="./assets/icons/prev.svg" alt="">
                </div>`;

    for (let i = 1; i <= totalPage; i++) {
        paginationHTML += `
            <div class="page-link ${i === currentPage ? 'current-page' : ''}"" onclick="goToPages(${i}, '${name}')">
                <span>${i}</span>
            </div>`;
    }

    paginationHTML += `
            <div id="next-page" onclick="nextPages('${name}')">
                <img src="./assets/icons/next.svg" alt="">
            </div>`;
    document.getElementById('paginate').innerHTML = paginationHTML;
}

/*
*
* ============= CRUD ===============
*
*/
function headerTableHTML(data, name) {
    let headerHTML = `
    <tr class="table-title">
    `;

    Object.keys(data[0]).forEach(key => {
        headerHTML += `<th>${key}</th>`;
    });

    headerHTML += `
        <th>Action</th>
        <th>
            <button class="multi-delete" onclick="deleteSelectedItems('${name}')">Xoá</button>
        </th>
    </tr>`;

    return headerHTML;
}
function itemTableHTML(name, item) {
    let itemHTML = '<tr>';
    
    Object.keys(item).forEach(key => {
        itemHTML += `<td>${item[key]}</td>`;
    });

    itemHTML += `
        <td>
            <div class="action">
                <div class="edit" onclick="editData('${name}', ${item.id})">
                    <img src="./assets/icons/pencil-write.svg" alt="">
                </div>
                <div class="delete" onclick="openConfirmPopup('${name}', ${item.id})"> <!-- Chuyển name thành chuỗi -->
                    <img src="./assets/icons/bin.svg" alt="">
                </div>
            </div>
        </td>
        <td>
            <input type="checkbox" value="${item.id}">
        </td>
    </tr>`;
    return itemHTML;
}
function showData(data, name) {
    if (data.length === 0) {
        alert("Không được xóa hết dữ liệu!!");
        return;
    }
    const paginatedData = paginate(data, currentPage);
    let headerHTML = headerTableHTML(data, name);

    paginatedData.forEach(item => {
        headerHTML += itemTableHTML(name, item)
    });
    document.getElementById('table').innerHTML = headerHTML;

    renderPaginationData(data, name)
}
function getFormData(name) {
    const formData = {};

    const formElements = document.querySelectorAll(`.${name}-form .form-group input, .${name}-form .form-group select`);
    formElements.forEach(input => {
        formData[input.name] = input.value;
    });

    return formData;
}
function clear(name) {
    const formElements = document.querySelectorAll(`.${name}-form .form-group input, .${name}-form .form-group select`);

    formElements.forEach(input => {
        input.value = '';
    });
}
function submitData(name){
    let data = getDataFromName(name);
    let request = getFormData(name)

    let index = data.findIndex((c)=>c.id == request.id)

    if(index >= 0){
        data.splice(index, 1, request)
    }else{   
        data.push(request)
    }

    showData(data, name)
    clear(name)
}
function deleteData(name, id){
    let data = getDataFromName(name);

    if (data) {
        for(let i=0; i<data.length; i++){
            if(data[i].id == id){
                data.splice(i,1);
                showData(data, name);
                break;
            }
        }
    } else {
        console.error("Unknown name:", name);
    }
}
function editData(name, id) {
    let data = getDataFromName(name);
    const formElements = document.querySelectorAll(`.${name}-form .form-group input, .${name}-form .form-group select`);

    for (let i = 0; i < data.length; i++) {
        if (data[i].id == id) {
            formElements.forEach(input => {
                const fieldName = input.name;
                input.value = data[i][fieldName];
            });
            
            break;
        }
    }
}

// ----- Show title Category in select on Book form -----
function loadSelectCategory(){
    let selectElement = document.getElementById('category');
    category.forEach(function(item) {
        let option = document.createElement('option');
        option.value = item.id; 
        option.textContent = item.title; 
        selectElement.appendChild(option); 
    });
}
/*
*
* ============= Confirm Popup Delete ===============
*
*/
function confirmPopupHTML(name, id) {
    return `<div id="confirmPopup-${name}-${id}" class="confirm-popup">
                <div class="confirm-content">
                    <span class="close" onclick="closeConfirmPopup('${name}', ${id})">&times;</span>
                    <p>Are you sure you want to delete this book?</p>
                    <div class="confirm-buttons">
                        <button onclick="confirmDelete('${name}', ${id})">Yes</button>
                        <button onclick="closeConfirmPopup('${name}', ${id})">No</button>
                    </div>
                </div>
            </div>`
}
function openConfirmPopup(name, id) {
    const bodyContent = document.querySelector('body');
    const htmlCode = confirmPopupHTML(name, id);

    bodyContent.insertAdjacentHTML('beforeend', htmlCode);
    
    const confirmPopupId = `confirmPopup-${name}-${id}`;
    document.getElementById(confirmPopupId).style.display = 'block';
}
function closeConfirmPopup(name, id) {
    const confirmPopupId = `confirmPopup-${name}-${id}`;
    document.getElementById(confirmPopupId).style.display = 'none';
}
function confirmDelete(name, id) {
    deleteData(name, id)
    closeConfirmPopup(name, id);
}

function getSelectedItems() {
    let checkboxes = document.querySelectorAll('#table input[type="checkbox"]:checked');
    console.log(checkboxes);
    let selectedIds = [];
    checkboxes.forEach(checkbox => {
        selectedIds.push(parseInt(checkbox.value));
    });
    return selectedIds;
}
function deleteSelectedItems(name) {
    let data = getDataFromName(name);
    let selectedIds = getSelectedItems();

    selectedIds.forEach(id => {
        let index = data.findIndex(item => item.id === id);
        if (index !== -1) {
            data.splice(index, 1);
        }
    });

    showData(data, name);
}


/*
*
* ============= Dashboard ===============
*
*/
function total() {
    let totalBooks = book.length;
    let totalCategories = category.length;
    
    let totalPrice = 0;
    book.forEach(function(bk) {
        totalPrice += bk.price;
    });
    
    document.querySelector('.title').textContent = 'Total Books';
    document.querySelector('.total strong').textContent = totalBooks;
    
    document.querySelectorAll('.title')[1].textContent = 'Total Category';
    document.querySelectorAll('.total strong')[1].textContent = totalCategories;
    
    document.querySelectorAll('.title')[2].textContent = 'Total Price';
    document.querySelectorAll('.total strong')[2].textContent = totalPrice.toFixed(2);
}


