$(document).ready(function(){
    $('#message_send').click(function() {
        var message_content = $('#chat-content').val();
        var _token = $('meta[name=csrf-token]').attr('content');
        $.post('addmessage', {contract_id: contract_id, _token: _token,
            receiver_id: receiver_id, sender_id: sender_id,
            message_content: message_content}, function(resp){
            var str = "";
            for(i=0;i<resp.length;i++){
                var obj_msg = resp[i];
                str += "<div class='alert alert-" + obj_msg.user_state + "'><strong>" + obj_msg.created_at + "</strong><P>" + obj_msg.message_content + "</p></div>";
            }
            $('#chat-content').val('');
            $('#ajax_message').html(str);
        });
    });
});