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

function handleCheckEmail(route) {
    const email = document.getElementById('email').value;
    const _token = document.getElementById('csrf_token').value;
    
    $('.icon-btn').html('<div class="loader"></div>');
    $.ajax({
        url: route,
        method: 'POST',
        data: {
            _token: _token,
            email: email,
        },
        success: function(response) {
            if (response == 1) {
                $('#layout-name-email').hide();
                $('#status-notification-message').hide();
                $('#layout-basic-information').show();
            }else {
                $('#status-notification-message').text('Email đã tồn tại!!');
            }
            $('.icon-btn').html('<i class="fa-solid fa-right-long"></i>');
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function handleCheckBasicInfor() {
    const address = document.getElementById('address').value;
    const birthday = document.getElementById('birthday').value;
    const tel = document.getElementById('tel').value;
    const gender = document.getElementById('gender').value;
    const messageNotify = document.getElementById('status-notification-message');

    if (address && birthday && tel && gender) {
        messageNotify.style.display = 'none';
        document.getElementById('layout-basic-information').style.display = 'none';
        document.getElementById('layout-password').style.display = 'block';
    }else{
        messageNotify.style.display = 'flex';
        messageNotify.innerHTML = 'Phải nhập đủ tất cả thông tin!!';
    }
}

function handleRegister(route, routeSuccess) {
    const _token = document.getElementById('csrf_token').value;
    const email = document.getElementById('email').value;
    const name = document.getElementById('name').value;
    const address = document.getElementById('address').value;
    const birthday = document.getElementById('birthday').value;
    const tel = document.getElementById('tel').value;
    const gender = document.getElementById('gender').value;
    const password = document.getElementById('password_register').value;

    $('.icon-btn').html('<div class="loader"></div>');
    $.ajax({
        url: route,
        method: 'POST',
        data: {
            _token: _token,
            email: email,
            name: name,
            address: address,
            tel: tel,
            birthday: birthday,
            gender: gender,
            password: password,
        },
        success: function(response) {
            if (response == 1) {
                displayFormRegisterSuccess(routeSuccess);
            }else {
                $('#status-notification-message').text('Lỗi!!');
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}
function loadingEffect() {
    const bodyContent = document.querySelector('body');
    let loading = `
    <section id="loadingEffect"
        style="width: 100%; 
                height: 100%; 
                background-color: #fff; 
                position: fixed; 
                display: flex;
                justify-content: center;
                align-items: center;
                opacity: 0.8;">
                <img src="./images/Hourglass.gif" alt="Loading.......">
    </section>
    `;
    bodyContent.insertAdjacentHTML('afterbegin', loading);
}
function displayFormRegisterSuccess(routeSuccess) {
    const verification = `
    <section class="form-register-success">
        <div class="">
            <div class="heading">
                <h1 class="">Đăng ký thành công!!</h1>
            </div>
            <p class="">Tài khoản của bạn đã được đăng ký thành công, hãy thử đăng nhập tài khoản của bạn</p>
            <div class="btn-wrapper">
                <a href="${routeSuccess}" class="btn-login">
                    <span>Đi đến trang đăng nhập</span>
                </a>
            </div>
        </div>
    </section>
    `;

    $('main').html(verification);
}

// convert to slug
function changeToSlug() {
    let name = document.getElementById('name').value;
    let slug = convertToSlug(name);
    document.getElementById('slug').value = slug;
}
function convertToSlug(text) {
    text = text.toLowerCase();
    let map = {
        'a': 'á|à|ã|ả|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
        'd': 'đ',
        'e': 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i': 'í|ì|ỉ|ĩ|ị',
        'o': 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u': 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'y': 'ý|ỳ|ỷ|ỹ|ỵ'
    };
    for (let pattern in map) {
        text = text.replace(new RegExp(map[pattern], 'g'), pattern);
    }
    return text.replace(/[^\w-]+/g, '-').replace(/--+/g, '-').replace(/^-+|-+$/g, '');
}

function showConfirmModal(id) {
    document.getElementById('confirmModal').style.display = 'block';

    document.getElementById('categoryId').value = id;
}

function hideConfirmModal() {
    document.getElementById('confirmModal').style.display = 'none';
}

function deleteCategory() {
    var categoryId = document.getElementById('categoryId').value;

    document.getElementById('deleteForm' + categoryId).submit();
}

function chooseQuantityOfBook() {
    const bookSelect = document.getElementById('bookSelect');
    const quantityFields = document.getElementById('quantityFields');

    bookSelect.addEventListener('change', function () {
        quantityFields.innerHTML = '';

        Array.from(bookSelect.selectedOptions).forEach(option => {
            const bookNameLabel = document.createElement('span');
            bookNameLabel.textContent = 'Quantity of: ' + option.textContent;
            quantityFields.appendChild(bookNameLabel);

            const quantityField = document.createElement('input');
            quantityField.setAttribute('type', 'number');
            quantityField.setAttribute('name', `quantities[${option.value}]`);
            quantityField.setAttribute('value', '1'); // Mặc định là 1
            quantityField.setAttribute('min', '1');
            quantityField.setAttribute('class', 'quantity-field');
            quantityFields.appendChild(quantityField);

            // Tạo một dòng mới
            const lineBreak = document.createElement('br');
            quantityFields.appendChild(lineBreak);
        });
    });
}
function loadNameFilesUpload() {
    document.querySelectorAll('.upload-photo').forEach(function (input) {
        input.addEventListener('change', function () {
            var fileName = input.files[0]?.name || "No file chosen";
            var label = input.parentElement.nextElementSibling;
            label.textContent = fileName;
        });
    });
}