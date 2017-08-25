$(document).ready(function(){
    $('.menu-currency').click(function() {
        var coin = $(this).attr('id');
        // $('#span_title').html(coin.toUpperCase());
        $('#div_trades').html('loading...');
        $('#div_trade_volume').html('loading...');
        $('#lbl_sell').html(coin.toUpperCase());
        $('#lbl_buy').html(coin.toUpperCase());
        $.get('gettrade?coin='+coin, function(resp){
            $('#div_trades').html(resp.trades);
            $('#div_trade_volume').html(resp.volumes);
            $('#div_trades').css('background','');
            $('#div_trade_volume').css('background','');
        });
        $.get('getfeedback?coin='+coin, function(response){
            resp = JSON.parse(response)
            htmlStr = 'No Data';
            if ( resp.data.length > 0 ){
                htmlStr = '';
                for(i=0;i<resp.data.length;i++) {
                    var data = resp.data[i];
                    htmlStr += '<div class="row"><div class="col-md-2 text-center div_cell"><label>'+data.date+'</label></div><div class="col-md-2 text-center div_cell"><label>'+data.user+'</label></div><div class="col-md-2 text-center div_cell"><label>'+data.outcome+'</label></div><div class="col-md-6 text-center div_cell"><label>'+data.feedback+'</label></div></div>';
                }
            }
            $('#feedback_content').html(htmlStr);
        });
    });
    $('#btn_send_email').click(function(){
        $.post('reportuser', {content: $('#report_user_content').val(), _token: $('meta[name=csrf-token]').attr('content')}, function(resp){
            // alert("");
        });
    });
});