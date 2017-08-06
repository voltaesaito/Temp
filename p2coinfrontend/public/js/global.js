/**
 * Created by administrator on 7/30/17.
 */
function doRealTime(){
    window.setInterval(function(){
        doOnLoadWindowData();
    },30000);
}
function doOnLoadWindowData() {
    var _token = $('meta[name=csrf-token]').attr('content');
    // $.post('getlastmessagelist', {_token: _token}, function(resp) {
    $.post(rootURL+'/getlastmessagelist', {_token: _token}, function(resp) {
        $('#msg_list').html(resp);
// console.log(resp);
    } );

    $.get(rootURL+'/getwalletamountbycoin', function(price_data){
        repjson = JSON.parse(price_data);
        $('#label_btc_amount').html(repjson.btc);
        $('#label_eth_amount').html(repjson.eth);
        console.log(price_data, typeof(price_data));
    });
}
$(function(){
    doRealTime();
});

