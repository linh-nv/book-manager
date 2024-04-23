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



document.addEventListener("DOMContentLoaded", function() {
    showCategory();
});
document.addEventListener("DOMContentLoaded", function() {
    var selectElement = document.getElementById('genre');
    data.forEach(function(item) {
        var option = document.createElement('option');
        option.value = item.id; 
        option.textContent = item.title; 
        selectElement.appendChild(option); 
    });
    // showCategory();
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
    }
]
function submitCategory(){
    var category_id = data[data.length - 1].id + 1;
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

const uploadPhotoInput = document.getElementById('upload-photo');
uploadPhotoInput.addEventListener('change', function(event) {
  const file = event.target.files[0];
  const imagePath = file.path;
  console.log(imagePath);
});



