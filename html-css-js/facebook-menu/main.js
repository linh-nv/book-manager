var avatarBox = document.querySelector('.avatar-box');
var cardAccountManage = document.getElementById('card-account-manage');

var notifyBtn = document.querySelector('.notify-btn');
var notifyIcon = document.querySelector('.notify-btn img');
var cardNotify = document.getElementById('card-notify');

var chatBtn = document.querySelector('.chat-btn');
var cardChat = document.getElementById('card-chat');
var chatIcon = document.querySelector('.chat-btn img');


var currentVisibleForm = null;

avatarBox.addEventListener('click', function() {
    if (currentVisibleForm !== cardAccountManage) {
        if (currentVisibleForm) {
            currentVisibleForm.style.display = 'none';
        }
        cardAccountManage.style.display = 'block';
        currentVisibleForm = cardAccountManage;
    } else {
        cardAccountManage.style.display = 'none';
        currentVisibleForm = null;
    }
});

notifyBtn.addEventListener('click', function() {
    if (currentVisibleForm !== cardNotify) {
        if (currentVisibleForm) {
            currentVisibleForm.style.display = 'none';
        }
        cardNotify.style.display = 'flex';
        notifyBtn.style.backgroundColor = '#233950';
        chatBtn.style.backgroundColor = '#3A3B3C';
        notifyIcon.src = './icon/notify-active.svg';
        chatIcon.src = './icon/message.svg';

        currentVisibleForm = cardNotify;
    } else {
        cardNotify.style.display = 'none';
        currentVisibleForm = null;
        notifyBtn.style.backgroundColor = '#3A3B3C';
        notifyIcon.src = './icon/notify.svg';

    }
});


chatBtn.addEventListener('click', function() {
    if (currentVisibleForm !== cardChat) {
        if (currentVisibleForm) {
            currentVisibleForm.style.display = 'none';
        }
        cardChat.style.display = 'block';
        chatBtn.style.backgroundColor = '#233950';
        notifyBtn.style.backgroundColor = '#3A3B3C';
        notifyIcon.src = './icon/notify.svg';
        chatIcon.src = './icon/message-active.svg';

        currentVisibleForm = cardChat;
    } else {
        cardChat.style.display = 'none';
        currentVisibleForm = null;
        chatBtn.style.backgroundColor = '#3A3B3C';
        chatIcon.src = './icon/message.svg';

    }
});