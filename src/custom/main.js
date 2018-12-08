$(document).ready(function(){
    var conn = new WebSocket('ws://localhost:8888');
    var chartForm = $('.chartForm'),
        messageInputField = chartForm.find('#message'),
        messageList = $(".messages-list");

    chartForm.on('submit', function(e){
        e.preventDefault();
        var message =  messageInputField.val();
        if(typeof message != "undefined" || message != ""){
            conn.send(message);
            messageList.prepend('<li>' + message + '</li>');
            messageInputField.val("");
        }    
    });
    
    conn.onopen = function(e) {
        console.log("Connection established!");
    };

    conn.onmessage = function(e) {
        console.log(e.data);
        messageList.prepend('<li>' + e.data + '</li>');
    };
});