//var contract_id;
//var receiver_id;
$(document).ready(function(){
    var contract_receiver_id = $("#user_menu li.active").attr('id');
    if (contract_receiver_id) {
        var arr = contract_receiver_id.split('-');
        eceiver_id = arr[0];
        contract_id = arr[1];
    }
    else {
        contract_receiver_id = receiver_id;
    }
    $('#message_send').click(function() {
        // var contract_receiver_id = $("#user_menu li.active").attr('id');
        // var arr = contract_receiver_id.split('-');
        // receiver_id = arr[0];
        // contract_id = arr[1];

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
        contract_id = tmp[1];
        var _token = $('meta[name=csrf-token]').attr('content');
        param = {contract_id: contract_id, _token: _token,
        receiver_id: tmp[0], sender_id: sender_id,
        message_content: 'NULL', message_state:"0" };
        getMessageContentAndDraw( param );
    });

    $('#release_transaction').click(function(){
        var _token = $('meta[name=csrf-token]').attr('content');
        $.post('gettransactionid', {contract_id:contract_id, _token:_token}, function(resp) {
            if ( resp != 'fail' ) {
                $.post('withdraw', {transaction_id: resp, _token:_token}, function(resp){
                    // $.get()

                    $.get('getwalletamountbycoin', function(resp){
                        $('#label_btc_amount').html(resp.btc);
                        $('#label_eth_amount').html(resp.eth);
                    });
                    $('#release_transaction').hide();
                    console.log(resp);
                });
             }
        } );
    });
});

function getMessageContentAndDraw( param ) {
    $.post('addmessage', param, function(resp){
        //console.log(resp.fee);
        if ( resp.fee.status == 'enable' ) {
            $('#release_transaction').removeClass('disabled');
            $('#release_transaction').addClass('active');
        }
        else{
            $('#release_transaction').removeClass('active');
            $('#release_transaction').addClass('disabled');
        }
        $('#pay_amount').val(resp.fee.total);
            
        var str = "";
        for(i=0;i<resp.content.length;i++){
            var obj_msg = resp.content[i];
            str += "<div class='alert alert-" + obj_msg.user_state + "'><strong>" + obj_msg.created_at + "</strong><P>" + obj_msg.message_content + "</p></div>";
        }
        $('#chat-content').val('');
        $('#ajax_message').html(str);
    });
}