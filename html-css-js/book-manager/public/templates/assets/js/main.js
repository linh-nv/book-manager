// Lấy phần tử menu click và sidebar menu
const menuClick = document.getElementById('menu-click');
const sidebarMenu = document.querySelector('.sidebar-menu');
const logo = document.querySelector('.logo');
const topBar = document.querySelector('.top-bar');
const sidebarItems = document.querySelectorAll('.sidebar-menu .product-text span');

// Thêm sự kiện click cho menu click
menuClick.addEventListener('click', function() {
    // Kiểm tra width hiện tại của sidebar menu
    const currentWidth = sidebarMenu.offsetWidth;

    // Kiểm tra nếu width hiện tại là 240px, thì đặt width mới là 100px, ngược lại đặt width mới là 240px
    if (currentWidth === 240) {
        sidebarMenu.style.width = '100px';
        logo.style.opacity = 0;
        topBar.style.width = 'calc(100vw - 100px)';
        
        // Với mỗi span trong sidebar items, đặt opacity là 0 và pointer-events là none
        sidebarItems.forEach(function(span) {
            span.style.opacity = '0';
            span.style.pointerEvents = 'none';
        });
    } else {
        sidebarMenu.style.width = '240px';
        logo.style.opacity = 1;
        topBar.style.width = 'calc(100vw - 240px)';
        
        // Với mỗi span trong sidebar items, đặt lại opacity và pointer-events về giá trị mặc định
        sidebarItems.forEach(function(span) {
            span.style.opacity = '';
            span.style.pointerEvents = '';
        });
    }
});





let formDataArray = [];

document.getElementById('upload-photo').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const imageUrl = URL.createObjectURL(file);
    console.log(imageUrl);
    formDataArray.push(imageUrl);
});


document.querySelector('.form-box').addEventListener('submit', function(event) {
    event.preventDefault();

    const firstName = document.getElementById('fist-name').value;
    const lastName = document.getElementById('last-name').value;
    const email = document.getElementById('your-email').value;
    const phoneNumber = document.getElementById('phone-number').value;
    const dateOfBirth = document.getElementById('date-of-birth').value;
    const genre = document.getElementById('genre').value;

    const formData = {
        firstName: firstName,
        lastName: lastName,
        email: email,
        phoneNumber: phoneNumber,
        dateOfBirth: dateOfBirth,
        genre: genre
    };

    // Thêm đối tượng formData vào formDataArray
    formDataArray = [...formDataArray, formData];

    // Log kết quả
    // console.log(formDataArray);
});


