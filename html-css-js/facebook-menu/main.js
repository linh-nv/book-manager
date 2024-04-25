
var cardAccountManage = document.getElementById('card-account-manage');
var cardNotify = document.getElementById('card-notify');
var cardChat = document.getElementById('card-chat');
var cardMenu = document.getElementById('card-menu');

var avatarBox = document.querySelector('.avatar-box');
var notifyBtn = document.querySelector('.notify-btn');
var chatBtn = document.querySelector('.chat-btn');
var menuBtn = document.querySelector('.menu-btn');

var notifyIcon = document.querySelector('.notify-btn img');
var chatIcon = document.querySelector('.chat-btn img');
var menuIcon = document.querySelector('.menu-btn img');


var currentVisibleForm = null;

avatarBox.addEventListener('click', function() {
    if (currentVisibleForm !== cardAccountManage) {
        if (currentVisibleForm) {
            currentVisibleForm.style.display = 'none';
        }
        cardAccountManage.style.display = 'block';
        currentVisibleForm = cardAccountManage;

        notifyBtn.style.backgroundColor = '#3A3B3C';
        notifyIcon.src = './icon/notify.svg';
        chatBtn.style.backgroundColor = '#3A3B3C';
        chatIcon.src = './icon/message.svg';
        menuBtn.style.backgroundColor = '#3A3B3C';
        menuIcon.src = './icon/menu.svg';

    } else {
        cardAccountManage.style.display = 'none';
        currentVisibleForm = null;
    }
});

notifyBtn.addEventListener('click', function() {
    showNotify();
    if (currentVisibleForm !== cardNotify) {
        if (currentVisibleForm) {
            currentVisibleForm.style.display = 'none';
        }
        cardNotify.style.display = 'flex';
        notifyBtn.style.backgroundColor = '#233950';
        notifyIcon.src = './icon/notify-active.svg';
        chatBtn.style.backgroundColor = '#3A3B3C';
        chatIcon.src = './icon/message.svg';
        menuBtn.style.backgroundColor = '#3A3B3C';
        menuIcon.src = './icon/menu.svg';

        currentVisibleForm = cardNotify;
    } else {
        cardNotify.style.display = 'none';
        currentVisibleForm = null;
        notifyBtn.style.backgroundColor = '#3A3B3C';
        notifyIcon.src = './icon/notify.svg';

    }
});


chatBtn.addEventListener('click', function() {
    showMessage()
    if (currentVisibleForm !== cardChat) {
        if (currentVisibleForm) {
            currentVisibleForm.style.display = 'none';
        }
        cardChat.style.display = 'block';
        chatBtn.style.backgroundColor = '#233950';
        notifyBtn.style.backgroundColor = '#3A3B3C';
        notifyIcon.src = './icon/notify.svg';
        menuBtn.style.backgroundColor = '#3A3B3C';
        menuIcon.src = './icon/menu.svg';
        chatIcon.src = './icon/message-active.svg';

        currentVisibleForm = cardChat;
    } else {
        cardChat.style.display = 'none';
        currentVisibleForm = null;
        chatBtn.style.backgroundColor = '#3A3B3C';
        chatIcon.src = './icon/message.svg';

    }
});

menuBtn.addEventListener('click', function() {
    showMessage()
    if (currentVisibleForm !== cardMenu) {
        if (currentVisibleForm) {
            currentVisibleForm.style.display = 'none';
        }
        cardMenu.style.display = 'flex';
        menuBtn.style.backgroundColor = '#233950';
        notifyBtn.style.backgroundColor = '#3A3B3C';
        notifyIcon.src = './icon/notify.svg';
        chatBtn.style.backgroundColor = '#3A3B3C';
        chatIcon.src = './icon/message.svg';

        menuIcon.src = './icon/menu-active.svg';

        currentVisibleForm = cardMenu;
    } else {
        cardMenu.style.display = 'none';
        currentVisibleForm = null;
        menuBtn.style.backgroundColor = '#3A3B3C';
        menuIcon.src = './icon/menu.svg';

    }
});


// ============= Notification ==================
var data_notify = [
    {
        "username": "Nguyễn Văn Linh",
        "status_notify": "image-notify-icon", 
        "content_notification": "Liệu mai sau phai vội mau không bước bên cạnh nhau (bên cạnh nhau), Thì ta có đau? (Thì ta có đau? Có đau?), Đôi mi nhòe phai ai sẽ lau?, Ai sẽ đến lau nỗi đau này?",
        "time": "10 phút trước"
    },
    {
        "username": "Nguyễn Thanh Tùng",
        "status_notify": "ring-notify-icon", 
        "content_notification": "Vô tâm quay lưng ta thờ ơ, lạnh lùng băng giá như vậy sao? (Vậy sao? Vậy sao?), Vờ không biết nhau (không biết nhau, không biết nhau), Lặng im băng qua chẳng nói một lời (chẳng nói một lời), Ooh-whoa-ooh-whoa-oh-oh-oh (yeah, eh)",
        "time": "11 phút trước"
    
    },
    {
        "username": "Sơn Tùng MTP",
        "status_notify": "video-notify-icon", 
        "content_notification": "Rồi niềm đau có chóng quên? (Hah-ah-ooh-ah), Hay càng quên càng nhớ thêm, vấn vương vết thương lòng xót xa?, Đừng như con nít (con nít), từng mặn nồng say đắm say (oh-oh-ah), Cớ sao khi chia tay (chia tay), ta xa lạ đến kì lạ? (Ta xa lạ đến kì lạ)",
        "time": "12 phút trước"
    
    },
    {
        "username": "Leo Messi",
        "status_notify": "birthday-notify-icon", 
        "content_notification": "Ai dám nói trước sau này (trước sau này), Chẳng ai biết trước tương lai sau này (sau này), Tình yêu đâu biết mai này có vẹn nguyên, Còn nguyên như lời ta đã hứa trước đây? (Ta đã hứa trước đây)",
        "time": "13 phút trước"
    
    },
    {
        "username": "CR7",
        "status_notify": "comment-notify-icon", 
        "content_notification": "Dẫu cho giông tố xô xa rời (xa rời), Còn mãi những điều đẹp đẽ say đắm một thời (một thời), Nụ cười và giọt nước mắt rơi từng trao cùng ta, Nhìn lại về phía mặt trời (phía mặt trời), Ta về phía mặt trời (phía mặt trời)",
        "time": "14 phút trước"
    
    },
    {
        "username": "Trịnh Trần Phương Tuấn",
        "status_notify": "ring-notify-icon", 
        "content_notification": "Yah, yah, Tương lai ngày mai ai nào hay (whoa), Yêu thương rồi buông đôi bàn tay (whoa), Mong manh đường duyên như vận may, Chia ly, hợp tan nhanh còn hơn mây trời bay (yah)",
        "time": "15 phút trước"
    
    },
    {
        "username": "Jack",
        "status_notify": "video-notify-icon", 
        "content_notification": "Quên nhau, vờ như chưa từng quen (sao quên?), Quên luôn mặt, quên luôn cả tên (sao quên?), Quên đi, làm sao mà đòi quên?, Khi câu thề xưa vẫn vẹn nguyên nên đừng cố quên (ah)",
        "time": "16 phút trước"
    
    },
    {
        "username": "Meo Meo",
        "status_notify": "comment-notify-icon", 
        "content_notification": "Vấn vương cũng chẳng sao mà (whoa), nhớ nhung cũng chẳng sao mà (whoa), Đớn đau cũng chẳng sao mà (whoa), Dù có đắng cay ta cũng chẳng sao đâu, Chân thành khi còn bên nhau và trân trọng hơn mỗi phút giây (hơn mỗi phút giây), Thành thật bên nhau mỗi phút giây (yeah, yeah)",
        "time": "17 phút trước"
    
    },
    {
        "username": "J97",
        "status_notify": "comment-notify-icon", 
        "content_notification": "Rồi niềm đau có chóng quên? (Hah-ah-ooh-ah), Hay càng quên càng nhớ thêm, vấn vương vết thương lòng xót xa? (Whoa-oh-oh-oh-oh-oh-oh), Đừng như con nít (con nít), từng mặn nồng say đắm say (oh-oh-ah), Cớ sao khi chia tay (chia tay), ta xa lạ đến kì lạ? (Ta xa lạ đến kì lạ, hah)",
        "time": "18 phút trước"
    
    },
    {
        "username": "Nguyễn Văn Linh",
        "status_notify": "comment-notify-icon", 
        "content_notification": "Ai dám nói trước sau này (trước sau này), Chẳng ai biết trước tương lai sau này (sau này), Tình yêu đâu biết mai này có vẹn nguyên, Còn nguyên như lời ta đã hứa trước đây? (Ta đã hứa trước đây)",
        "time": "19 phút trước"
    
    }
]

function showNotify(){
    var notify_new_content = ``
    for(let i=0; i<2; i++){
        notify_new_content += `
            <a href="#notify" class="notify-element button">
                <div class="notify-image">
                    <img src="./images/avatar.png" alt="">
                    <i class="notify-icon ${data_notify[i].status_notify}"></i>
                </div>
                <div class="notify-description">
                    <div class="notify-message-content">
                        <span class="notify-message-user-name">${data_notify[i].username}&nbsp;</span>${data_notify[i].content_notification}
                    </div>
                    <div class="notify-message-time">
                        <span>${data_notify[i].time}</span>
                    </div>
                </div>
                <div class="dot"></div>
            </a>
        `
    }
    document.getElementById('content_new').innerHTML = notify_new_content;

    var notify_bottom_content = ``
    for(let i=2; i<data_notify.length; i++){
        notify_bottom_content += `
            <a href="#notify" class="notify-element button">
                <div class="notify-image">
                    <img src="./images/avatar.png" alt="">
                    <i class="notify-icon ${data_notify[i].status_notify}"></i>
                </div>
                <div class="notify-description">
                    <div class="notify-message-content">
                        <span class="notify-message-user-name">${data_notify[i].username}&nbsp;</span>${data_notify[i].content_notification}
                    </div>
                    <div class="notify-message-time">
                        <span>${data_notify[i].time}</span>
                    </div>
                </div>
                <div class="dot"></div>
            </a>
        `
    document.getElementById('previous_content').innerHTML = notify_bottom_content;
    }
}

// ====================== Message ===============================

var data_message = [
    {
        "username": "Nguyễn Văn Linh",
        "message": "Liệu mai sau phai vội mau không bước bên cạnh nhau (bên cạnh nhau), Thì ta có đau? (Thì ta có đau? Có đau?), Đôi mi nhòe phai ai sẽ lau?, Ai sẽ đến lau nỗi đau này?",
        "time": "21 phút trước"
    },
    {
        "username": "Nguyễn Thanh Tùng",
        "message": "Vô tâm quay lưng ta thờ ơ, lạnh lùng băng giá như vậy sao? (Vậy sao? Vậy sao?), Vờ không biết nhau (không biết nhau, không biết nhau), Lặng im băng qua chẳng nói một lời (chẳng nói một lời), Ooh-whoa-ooh-whoa-oh-oh-oh (yeah, eh)",
        
        "time": "32 phút trước"
    },
    {
        "username": "Sơn Tùng MTP",
        "message": "Rồi niềm đau có chóng quên? (Hah-ah-ooh-ah), Hay càng quên càng nhớ thêm, vấn vương vết thương lòng xót xa?, Đừng như con nít (con nít), từng mặn nồng say đắm say (oh-oh-ah), Cớ sao khi chia tay (chia tay), ta xa lạ đến kì lạ? (Ta xa lạ đến kì lạ)",
        
        "time": "34 phút trước"
    },
    {
        "username": "Leo Messi",
        "message": "Ai dám nói trước sau này (trước sau này), Chẳng ai biết trước tương lai sau này (sau này), Tình yêu đâu biết mai này có vẹn nguyên, Còn nguyên như lời ta đã hứa trước đây? (Ta đã hứa trước đây)",
        
        "time": "35 phút trước"
    },
    {
        "username": "CR7",
        "message": "Dẫu cho giông tố xô xa rời (xa rời), Còn mãi những điều đẹp đẽ say đắm một thời (một thời), Nụ cười và giọt nước mắt rơi từng trao cùng ta, Nhìn lại về phía mặt trời (phía mặt trời), Ta về phía mặt trời (phía mặt trời)",
        
        "time": "36 phút trước"
    },
    {
        "username": "Trịnh Trần Phương Tuấn",
        "message": "Yah, yah, Tương lai ngày mai ai nào hay (whoa), Yêu thương rồi buông đôi bàn tay (whoa), Mong manh đường duyên như vận may, Chia ly, hợp tan nhanh còn hơn mây trời bay (yah)",
        
        "time": "37 phút trước"
    },
    {
        "username": "Jack",
        "message": "Quên nhau, vờ như chưa từng quen (sao quên?), Quên luôn mặt, quên luôn cả tên (sao quên?), Quên đi, làm sao mà đòi quên?, Khi câu thề xưa vẫn vẹn nguyên nên đừng cố quên (ah)",
        
        "time": "45 phút trước"
    },
    {
        "username": "Meo Meo",
        "message": "Vấn vương cũng chẳng sao mà (whoa), nhớ nhung cũng chẳng sao mà (whoa), Đớn đau cũng chẳng sao mà (whoa), Dù có đắng cay ta cũng chẳng sao đâu, Chân thành khi còn bên nhau và trân trọng hơn mỗi phút giây (hơn mỗi phút giây), Thành thật bên nhau mỗi phút giây (yeah, yeah)",
        
        "time": "46 phút trước"
    }
]

function showMessage(){
    var message = ``
    for(let i=2; i<data_message.length; i++){
        message += `
            <a href="#message" class="notify-element button">
                <div class="notify-image">
                    <img src="./images/avatar.png" alt="">
                    <i class="dots-green"></i>
                </div>
                <div class="notify-description">
                    <div class="notify-message-content">
                        <span class="notify-message-user-name">${data_message[i].username}</span>
                        <br/>
                        <p>${data_message[i].message}</p>
                    </div>
                    <div class="notify-message-time">
                        <span>${data_message[i].time}</span>
                    </div>
                </div>
                <div class="dot"></div>
            </a>
        `
    document.getElementById('message_content').innerHTML = message;
    }
}

// menu
