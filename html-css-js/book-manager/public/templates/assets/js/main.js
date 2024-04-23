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
    showCategory();
});
document.addEventListener("DOMContentLoaded", function() {
    var selectElement = document.getElementById('category');
    data.forEach(function(item) {
        var option = document.createElement('option');
        option.value = item.id; 
        option.textContent = item.title; 
        selectElement.appendChild(option); 
    });
});
var data = [
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
    var category_title = document.getElementById('category-title').value
    var category_id = document.getElementById('category-id').value

    var item = {
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

function showCategory(){
    table = `
    <tr class="table-title">
        <th>ID</th>
        <th>Category</th>
        <th>Action</th>
    </tr>
    `
    for(let i=0; i<data.length; i++){
        table += `
        <tr>
            <td>${data[i].id}</td>
            <td>${data[i].title}</td>
            <td>
                <div class="action">
                    <div class="edit" onclick="editCategory(${data[i].id})">
                        <img src="./assets/icons/pencil-write.svg" alt="">
                    </div>
                    <div class="delete" onclick="deleteCategory(${data[i].id})">
                        <img src="./assets/icons/bin.svg" alt="">
                    </div>
                </div>
            </td>
        </tr>
        `
    }
    document.getElementById('table').innerHTML = table;
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


// book
document.addEventListener("DOMContentLoaded", function() {
    showBook();
});
var data_book = [
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
        "author": "Harper Lee",
        "publisher": "J. B. Lippincott & Co.",
        "price": 10.50,
        "category": 2 // Classic
    },
    {
        "id": 5,
        "title": "1984",
        "image": "https://example.com/1984.jpg",
        "author": "George Orwell",
        "publisher": "Secker & Warburg",
        "price": 9.99,
        "category": 3 // Science Fiction
    }
]

function submitBook(){
    var book_title = document.getElementById('book-title').value
    var book_id = document.getElementById('book-id').value
    var book_image = document.getElementById('book-image').value
    var book_author = document.getElementById('book-author').value
    var book_publisher = document.getElementById('book-publisher').value
    var book_price = document.getElementById('book-price').value
    var book_category = document.getElementById('category').value;

    var item_book = {
        id: book_id,
        title: book_title,
        image: book_image,
        author: book_author,
        publisher: book_publisher,
        price: book_price,
        category: book_category
    }

    let index_book = data_book.findIndex((c)=>c.id == item_book.id)
    console.log(index_book);
    if(index_book >= 0){
        data_book.splice(index_book, 1, item_book)
    }else{   
        data_book.push(item_book)
    }

    showBook()
    clearBook()
}

function showBook(){
    table_book = `
    <tr class="table-title">
        <th>Image</th>
        <th>ID</th>
        <th>Category</th>
        <th>Title</th>
        <th>Author</th>
        <th>Publisher</th>
        <th>Price</th>
        <th>Action</th>
    </tr>
    `
    for(let i=0; i<data_book.length; i++){
        table_book += `
        <tr>
            <td>${data_book[i].image}</td>
            <td>${data_book[i].id}</td>
            <td>${data_book[i].category}</td>
            <td>${data_book[i].title}</td>
            <td>${data_book[i].author}</td>
            <td>${data_book[i].publisher}</td>
            <td>${data_book[i].price}</td>
            <td>
                <div class="action">
                    <div class="edit" onclick="editBook(${data_book[i].id})">
                        <img src="./assets/icons/pencil-write.svg" alt="">
                    </div>
                    <div class="delete" onclick="deleteBook(${data_book[i].id})">
                        <img src="./assets/icons/bin.svg" alt="">
                    </div>
                </div>
            </td>
        </tr>
        `
    }
    document.getElementById('table-book').innerHTML = table_book;
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
    for(let i=0; i<data_book.length; i++){
        if(data_book[i].id == id){
            data_book.splice(i,1)

            showBook()
        }
    }
}
function editBook(id){
    for(let i=0; i<data_book.length; i++){
        if(data_book[i].id == id){
            document.getElementById('book-title').value = data_book[i].title
            document.getElementById('book-id').value = data_book[i].id
            document.getElementById('book-image').value = data_book[i].image
            document.getElementById('book-author').value = data_book[i].author
            document.getElementById('book-publisher').value = data_book[i].publisher
            document.getElementById('book-price').value = data_book[i].price
            document.getElementById("category").value = data_book[i].category;
        }
    }
}

// Tính tổng số sách
var totalBooks = data_book.length;

var totalCategories = data.length;


// Tính tổng giá của tất cả các cuốn sách
var totalPrice = 0;
data_book.forEach(function(book) {
    totalPrice += book.price;
});

// Đổ dữ liệu vào các trường HTML
document.querySelector('.title').textContent = 'Total Books';
document.querySelector('.total strong').textContent = totalBooks;

document.querySelectorAll('.title')[1].textContent = 'Total Category';
document.querySelectorAll('.total strong')[1].textContent = totalCategories;

document.querySelectorAll('.title')[2].textContent = 'Total Price';
document.querySelectorAll('.total strong')[2].textContent = totalPrice.toFixed(2); // Làm tròn đến 2 chữ số thập phân
