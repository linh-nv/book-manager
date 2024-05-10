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
            console.log(response);
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

    // loadingEffect('flex');
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
            console.log(response);
            if (response == 1) {
                // loadingEffect('none');
                displayVerification(routeSuccess);
            }else {
                $('#status-notification-message').text('Lỗi!!');
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}



function loadingEffect(display) {
    const bodyContent = document.querySelector('body');
    let loading = `
    <section id="loadingEffect"
        style="width: 100%; 
                height: 100%; 
                background-color: #fff; 
                position: fixed; 
                display: ${display};
                justify-content: center;
                align-items: center;
                opacity: 0.8;">
                <img src="./images/Hourglass.gif" alt="Loading.......">
    </section>
    `;
    bodyContent.insertAdjacentHTML('afterbegin', loading);
}

function displayVerification(routeSuccess) {
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


function handleCheckValue(name, email, password, route) {
    $.ajax({
        url: route,
        method: 'POST',
        data: {
            _token: $('#csrf_token').val(),
            email: email,
            name: name,
            password: password,
        },
        success: function(response) {
            console.log(response);
            $('#loadingEffect').hide();
            displayVerification();
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}
