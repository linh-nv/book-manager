const menuClick = document.getElementById('menu-click');
const sidebarMenu = document.querySelector('.sidebar-menu');
const logo = document.querySelector('.logo');
const topBar = document.querySelector('.top-bar');
const sidebarItems = document.querySelectorAll('.sidebar-menu .product-text span');

menuClick.addEventListener('click', function() {
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
});




// category
document.addEventListener("DOMContentLoaded", function() {
    let selectElement = document.getElementById('category');
    data.forEach(function(item) {
        let option = document.createElement('option');
        option.value = item.id; 
        option.textContent = item.title; 
        selectElement.appendChild(option); 
    });
});
let data = [
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


function submitCategory(){
    let category_title = document.getElementById('category-title').value
    let category_id = document.getElementById('category-id').value

    let item = {
        id: category_id,
        title: category_title
    }

    let index = data.findIndex((c)=>c.id == item.id)
    console.log(index);
    if(index >= 0){
        data.splice(index, 1, item)
    }else{   
        data.push(item)
    }

    showCategory()
    clearCategory()
}

// ======================= paginate ============================
const itemsPerPageCategory = 3; // Số phần tử mỗi trang
let currentPage = 1; // Mặc định trang hiện tại

function paginate(data, page) {
    const startIndex = (page - 1) * itemsPerPageCategory;
    const endIndex = startIndex + itemsPerPageCategory;
    return data.slice(startIndex, endIndex);
}

function showCategory() {
    const paginatedData = paginate(data, currentPage);

    let table = `
        <tr class="table-title">
            <th>ID</th>
            <th>Category</th>
            <th>Action</th>
            <th>
                <button class="multi-delete" onclick="deleteSelectedItemsCategory()">Xoá</button>
            </th>
        </tr>
    `;

    paginatedData.forEach(item => {
        table += `
            <tr>
                <td>${item.id}</td>
                <td>${item.title}</td>
                <td>
                    <div class="action">
                        <div class="edit" onclick="editCategory(${item.id})">
                            <img src="./assets/icons/pencil-write.svg" alt="">
                        </div>
                        <div class="delete" onclick="openConfirmPopup(${item.id})">
                            <img src="./assets/icons/bin.svg" alt="">
                        </div>
                    </div>
                </td>
                <td>
                    <input type="checkbox" value="${item.id}">
                </td>
            </tr>
            <div id="confirmPopup" class="confirm-popup">
                <div class="confirm-content">
                    <span class="close" onclick="closeConfirmPopup()">&times;</span>
                    <p>Are you sure you want to delete this book?</p>
                    <div class="confirm-buttons">
                        <button onclick="confirmDelete()">Yes</button>
                        <button onclick="closeConfirmPopup()">No</button>
                    </div>
                </div>
            </div>
        `;
    });

    document.getElementById('table').innerHTML = table;
    renderPagination()
}
function getSelectedItemsCategory() {
    let checkboxesCategory = document.querySelectorAll('#table input[type="checkbox"]:checked');
    let selectedIdsCategory = [];
    checkboxesCategory.forEach(checkbox => {
        selectedIdsCategory.push(parseInt(checkbox.value));
    });
    return selectedIdsCategory;
}

function deleteSelectedItemsCategory() {
    let selectedIdsCategory = getSelectedItemsCategory();
    data = data.filter(item => !selectedIdsCategory.includes(item.id));
    showCategory();
}


function prevPageCategory() {
    if (currentPage > 1) {
        currentPage--;
        showCategory();
    }
}

function nextPageCategory() {
    const totalPages = Math.ceil(data.length / itemsPerPageCategory);
    if (currentPage < totalPages) {
        currentPage++;
        showCategory();
    }
}

function goToPage(page) {
    currentPage = page;
    showCategory();
}

function renderPagination() {
    let totalPages = Math.ceil(data.length / itemsPerPageCategory);
    let paginationHTML = `
            <div id="prev-page" onclick="prevPageCategory()">
                    <img src="./assets/icons/prev.svg" alt="">
                </div>
                `;

    for (let i = 1; i <= totalPages; i++) {
        paginationHTML += `
            <div class="page-link" onclick="goToPage(${i})">
                <span>${i}</span>
            </div>
        `;
    }

    paginationHTML += `
            <div id="next-page" onclick="nextPageCategory()">
                <img src="./assets/icons/next.svg" alt="">
            </div>`
    document.getElementById('paginate').innerHTML = paginationHTML;
}


function clearCategory(){
    document.getElementById('category-title').value = ""
    document.getElementById('category-id').value = ""
}
function deleteCategory(id){
    for(let i=0; i<data.length; i++){
        if(data[i].id == id){
            data.splice(i,1)

            showCategory()
        }
    }

}
function editCategory(id){
    for(let i=0; i<data.length; i++){
        if(data[i].id == id){
            document.getElementById('category-id').value = data[i].id
            document.getElementById('category-title').value = data[i].title
        }
    }
}
function openConfirmPopup(id) {
    document.getElementById('confirmPopup').style.display = 'block';
    document.getElementById('id_delete_category').value = id;
}

function closeConfirmPopup() {
    document.getElementById('confirmPopup').style.display = 'none';
}

function confirmDelete() {
    let id_delete_category = document.getElementById('id_delete_category').value;
    deleteCategory(id_delete_category)
    closeConfirmPopup();
}

// book
let dataBook = [
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

function submitBook(){
    let bookTitle = document.getElementById('book-title').value
    let bookId = document.getElementById('book-id').value
    let bookImage = document.getElementById('book-image').value
    let bookAuthor = document.getElementById('book-author').value
    let bookPublisher = document.getElementById('book-publisher').value
    let bookPrice = document.getElementById('book-price').value
    let bookCategory = document.getElementById('category').value;

    let item_book = {
        id: bookId,
        title: bookTitle,
        image: bookImage,
        author: bookAuthor,
        publisher: bookPublisher,
        price: bookPrice,
        category: bookCategory
    }

    let index_book = dataBook.findIndex((c)=>c.id == item_book.id)
    console.log(index_book);
    if(index_book >= 0){
        dataBook.splice(index_book, 1, item_book)
    }else{   
        dataBook.push(item_book)
    }

    showBook()
    clearBook()
}
function openConfirmPopupBook(id) {
    document.getElementById('id_delete_book').value = id;
    document.getElementById('confirmPopup').style.display = 'block';
}

function closeConfirmPopupBook() {
    document.getElementById('confirmPopup').style.display = 'none';
}

function confirmDeleteBook() {
    let idDeleteBook = document.getElementById('id_delete_book').value;
    deleteBook(idDeleteBook)
    closeConfirmPopup();
}

// ======================= paginate book ============================
const itemsPerPageBook = 3; // Số phần tử mỗi trang
let currentPageBook = 1; // Mặc định trang hiện tại

function paginateBook(data, page) {
    const startIndexBook = (page - 1) * itemsPerPageBook;
    const endIndexBook = startIndexBook + itemsPerPageBook;
    return data.slice(startIndexBook, endIndexBook);
}
function showBook(){
    const paginatedDataBook = paginateBook(dataBook, currentPageBook);

    let table_book = `
    <tr class="table-title">
        <th>Image</th>
        <th>ID</th>
        <th>Category</th>
        <th>Title</th>
        <th>Author</th>
        <th>Publisher</th>
        <th>Price</th>
        <th>Action</th>
        <th>
            <button class="multi-delete" onclick="deleteSelectedItems()">Xoá</button>
        </th>
    </tr>
    `
    paginatedDataBook.forEach(item => {
        table_book += `
        <tr>
            <td>${item.image}</td>
            <td>${item.id}</td>
            <td>${item.category}</td>
            <td>${item.title}</td>
            <td>${item.author}</td>
            <td>${item.publisher}</td>
            <td>${item.price}</td>
            <td>
                <div class="action">
                    <div class="edit" onclick="editBook(${item.id})">
                        <img src="./assets/icons/pencil-write.svg" alt="">
                    </div>
                    <div class="delete" onclick="openConfirmPopupBook(${item.id})">
                        <img src="./assets/icons/bin.svg" alt="">
                    </div>
                </div>
            </td>
            <td>
                <input type="checkbox" value="${item.id}">
            </td>
        </tr>
        <div id="confirmPopup" class="confirm-popup">
            <div class="confirm-content">
                <span class="close" onclick="closeConfirmPopupBook()">&times;</span>
                <p>Are you sure you want to delete this book?</p>
                <div class="confirm-buttons">
                    <button onclick="confirmDeleteBook()">Yes</button>
                    <button onclick="closeConfirmPopupBook()">No</button>
                </div>
            </div>
        </div>`
    });

    document.getElementById('table-book').innerHTML = table_book;
    renderPaginationBook()
}

function getSelectedItems() {
    let checkboxes = document.querySelectorAll('#table-book input[type="checkbox"]:checked');
    let selectedIds = [];
    checkboxes.forEach(checkbox => {
        selectedIds.push(parseInt(checkbox.value));
    });
    return selectedIds;
}

// Hàm xóa các item đã chọn khỏi mảng dữ liệu
function deleteSelectedItems() {
    let selectedIds = getSelectedItems();
    dataBook = dataBook.filter(item => !selectedIds.includes(item.id));
    showBook();
}

function prevPageBook() {
    if (currentPageBook > 1) {
        currentPageBook--;
        showBook();
    }
}

function nextPageBook() {
    let totalPagesBook = Math.ceil(dataBook.length / itemsPerPageBook);
    if (currentPageBook < totalPagesBook) {
        currentPageBook++;
        showBook();
    }
}

function goToPageBook(page) {
    currentPageBook = page;
    showBook();
}
function renderPaginationBook() {
    let totalPagesBook = Math.ceil(dataBook.length / itemsPerPageCategory);
    let paginationHTML = `
            <div id="prev-page" onclick="prevPageBook()">
                    <img src="./assets/icons/prev.svg" alt="">
                </div>
                `;

    for (let i = 1; i <= totalPagesBook; i++) {
        paginationHTML += `
            <div class="page-link" onclick="goToPageBook(${i})">
                <span>${i}</span>
            </div>
        `;
    }

    paginationHTML += `
            <div id="next-page" onclick="nextPageBook()">
                <img src="./assets/icons/next.svg" alt="">
            </div>`
    document.getElementById('paginate').innerHTML = paginationHTML;
}


function clearBook(){
    document.getElementById('book-title').value = ''
    document.getElementById('book-id').value = ''
    document.getElementById('book-image').value = ''
    document.getElementById('book-author').value = ''
    document.getElementById('book-publisher').value = ''
    document.getElementById('book-price').value = ''
    document.getElementById("category").value = '';
}
function deleteBook(id){
    for(let i=0; i<dataBook.length; i++){
        if(dataBook[i].id == id){
            dataBook.splice(i,1)

            showBook()
        }
    }

}
function editBook(id){
    for(let i=0; i<dataBook.length; i++){
        if(dataBook[i].id == id){
            document.getElementById('book-title').value = dataBook[i].title
            document.getElementById('book-id').value = dataBook[i].id
            document.getElementById('book-image').value = dataBook[i].image
            document.getElementById('book-author').value = dataBook[i].author
            document.getElementById('book-publisher').value = dataBook[i].publisher
            document.getElementById('book-price').value = dataBook[i].price
            document.getElementById("category").value = dataBook[i].category;
        }
    }
}

// Tính tổng số sách
let totalBooks = dataBook.length;
let totalCategories = data.length;

// Tính tổng giá của tất cả các cuốn sách
let totalPrice = 0;
dataBook.forEach(function(book) {
    totalPrice += book.price;
});

document.querySelector('.title').textContent = 'Total Books';
document.querySelector('.total strong').textContent = totalBooks;

document.querySelectorAll('.title')[1].textContent = 'Total Category';
document.querySelectorAll('.total strong')[1].textContent = totalCategories;

document.querySelectorAll('.title')[2].textContent = 'Total Price';
document.querySelectorAll('.total strong')[2].textContent = totalPrice.toFixed(2);

// search
function search() {
    let searchValue = document.getElementById('search').value.trim().toLowerCase();
    let searchResult = document.getElementById('search-result');

    if (searchValue) {
        let list_category = "";
        for (let i = 0; i < data.length; i++) {
            const title = data[i].title.toLowerCase(); 

            if (title.indexOf(searchValue) !== -1) {
                list_category += `
                <li>ID category: ${data[i].id}<br/> Title Category: ${data[i].title} </li>`;
            }
        }
        for (let i = 0; i < dataBook.length; i++) {
            const title = dataBook[i].title.toLowerCase(); 

            if (title.indexOf(searchValue) !== -1) {
                list_category += `
                <li>ID book: ${dataBook[i].id}<br/> Title Book: ${dataBook[i].title} </li>`;
            }
        }
        searchResult.innerHTML = list_category ? list_category : "<p>No matching categories, books found.</p>";
        searchResult.style.display = "block";
    } else {
        searchResult.style.display = "none";
    }
}


  

