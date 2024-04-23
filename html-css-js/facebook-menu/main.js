var avatarBox = document.querySelector('.avatar-box');
var cardAccountManage = document.getElementById('card-account-manage');

var notifyBtn = document.querySelector('.notify-btn');
var cardNotify = document.getElementById('card-notify');

var chatBtn = document.querySelector('.chat-btn');
var cardChat = document.getElementById('card-chat');

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
        currentVisibleForm = cardNotify;
    } else {
        cardNotify.style.display = 'none';
        currentVisibleForm = null;
    }
});

chatBtn.addEventListener('click', function() {
    if (currentVisibleForm !== cardChat) {
        if (currentVisibleForm) {
            currentVisibleForm.style.display = 'none';
        }
        cardChat.style.display = 'block';
        currentVisibleForm = cardChat;
    } else {
        cardChat.style.display = 'none';
        currentVisibleForm = null;
    }
});