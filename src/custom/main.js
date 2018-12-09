$(document).ready(function(){
    var conn = new WebSocket('ws://localhost:8888');
    var chartForm = $('.chartForm'),
        messageInputField = chartForm.find('#message'),
        messageList = $('.messages-list'),
        usernameForm = $('.username-setter'),
        usernameInput = usernameForm.find('.username-input');

    chartForm.on('submit', function(e){
        e.preventDefault();
        var message = {
            text: messageInputField.val(),
            sender: Cookies.get('chat_name'),
            type: 'message'
        };
        if(typeof message != "undefined" || message != ""){
            conn.send(JSON.stringify(message));
            messageList.prepend('<li class="nav-item"><span class="badge badge-success">' + this.text + '</span></li>');
            messageInputField.val("");
        }    
    });

    usernameForm.on('submit', function(e){
        e.preventDefault();
        var chatName =  usernameInput.val();
        if(chatName.length > 0){
            Cookies.set('chat_name', chatName);
            $('.username').text(chatName);
            usernameInput.val("");
        }
    });
    
    conn.onopen = function(e) {
        console.log("Connection established!");
        $.ajax({
            url: '/websockets/load_history.php',
            dataType: 'json',
            success: function(data){
                $.each(data, function(){
                    if(this.sender == Cookies.get('chat_name')){
                        messageList.prepend('<li class="nav-item"><span class="badge badge-success">' + this.text + '</span></li>');
                    }
                    else{
                        messageList.prepend('<li class="nav-item"><span class="badge badge-secondary">' + this.text + '</span></li>');
                    }
                })
            }
        });

        var chatName = Cookies.get('chat_name');
        if(!chatName){
            var timestamp = (new Date()).getTime();
            chatName = 'anonymous' + timestamp;
            Cookies.set('chat_name', chatName);
        }

        $('.username').text(chatName);
    };

    conn.onmessage = function(e) {
        console.log(e.data);
        messageList.prepend('<li class="nav-item"><span class="badge badge-secondary">' + e.data + '</span></li>');
    };
});
