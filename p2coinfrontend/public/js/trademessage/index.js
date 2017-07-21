$(document).ready(function(){
    $('#message_send').click(function() {
        var contract_receiver_id = $("#user_menu li.active").attr('id');
        var arr = contract_receiver_id.split('-');
        var receiver_id = arr[0];
        var contract_id = arr[1];

        var message_content = $('#chat-content').val();
        var _token = $('meta[name=csrf-token]').attr('content');
        param = {contract_id: contract_id, _token: _token,
        receiver_id: receiver_id, sender_id: sender_id,
        message_content: message_content, message_state:"0" };
        getMessageContentAndDraw( param );
    });
    $('a.contract').click(function(){
        var id = $("#user_menu li.active").attr('id');
        var parentNode = $(this)[0].parentNode;
        $('#user_menu li').removeClass('active');
        $('#'+parentNode.id).addClass('active');
        var tmp = parentNode.id.split('-');
        var contract_id = tmp[1];
        var _token = $('meta[name=csrf-token]').attr('content');
        param = {contract_id: contract_id, _token: _token,
        receiver_id: tmp[0], sender_id: sender_id,
        message_content: 'NULL', message_state:"0" };
        getMessageContentAndDraw( param );
    });
});
function getMessageContentAndDraw( param ) {
    $.post('addmessage', param, function(resp){
        var str = "";
        for(i=0;i<resp.length;i++){
            var obj_msg = resp[i];
            str += "<div class='alert alert-" + obj_msg.user_state + "'><strong>" + obj_msg.created_at + "</strong><P>" + obj_msg.message_content + "</p></div>";
        }
        $('#chat-content').val('');
        $('#ajax_message').html(str);
    });
}