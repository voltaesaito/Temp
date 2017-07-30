/**
 * Created by administrator on 7/30/17.
 */
window.setInterval(1000, function(){
    var _token = $('meta[name=csrf-token]').attr('content');
    $.post('getlastmessagelist', {_token: _token}, function(resp) {
        $('#msg_list').html(resp);
    } );

    $.get('getwalletamountbycoin', function(resp){
        $('#label_btc_amount').html(resp.btc);
        $('#label_eth_amount').html(resp.eth);
    });
});
