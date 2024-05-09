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

function loadingEffect() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password_register').value;
    const confirm_pass = document.getElementById('confirm_pass').value;
    const storeRoute = 'route("store")';

    if (name !== '' && email !== '' && password !== '' && confirm_pass === password) {
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

        handleCheckValue(name, email, password, storeRoute);
    }else{
        alert('Nhập thông tin bị thiếu hoặc sai!!')
    }
}

function displayVerification() {
    const verification = `
        <section class="verification w-full h-full p-10 top-0 left-0 rounded-xl text-center items-center justify-center">
        <div class="">
            <div class="heading w-full flex justify-center pt-10">
            <h1 class="text-4xl font-semibold uppercase">Đăng ký thành công!!</h1>
            </div>
            <p class="text-2xl mt-20">Tài khoản của bạn đã được đăng ký thành công, hãy thử đăng nhập tài khoản của bạn</p>
            <div class="flex w-full justify-center mt-20">
            <a href="https://mail.google.com/mail/" class="flex bg-red-700 py-2 px-8 text-2xl font-bold gap-4 rounded-xl items-center text-white">
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
