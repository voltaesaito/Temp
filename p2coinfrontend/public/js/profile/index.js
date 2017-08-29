var seemore_flag = -1;
var CStandard = function () {
}

CStandard.prototype = {
    init : function() {
        this.initEventListen();
        this.loadListingData(1);
    },
    initEventListen : function () {
        $('button.see-more').click(j_obj.doOnSetSeeMoreFlag);
        $('button.view').click(j_obj.doViewMessages);
        $('.menu-currency').click(j_obj.dochangecoin);
    },
    doOnSetSeeMoreFlag : function() {
        seemore_flag = $(this).attr('prop'); 
        j_obj.loadListingData(0);
    },
    doViewMessages : function (param) {
        var _token = $('meta[name=csrf-token]').attr('content');
        var form = document.createElement("form");
        var element1 = document.createElement("input"); 
        var element2 = document.createElement("input"); 
    
        form.method = "POST";
        form.action = "trademessage";   

        element1.value=param;
        element1.type = "hidden";
        element1.name="param";
        form.appendChild(element1);  

        element2.value=_token;
        element2.type = "hidden";
        element2.name="_token";
        form.appendChild(element2);

        document.body.appendChild(form);

        form.submit();
    },
    dochangecoin : function() {
        var coin = $(this).attr('id');
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
        j_obj.loadListingData(1, coin);
    },
    loadListingData : function (flag, coin_type = 'btc') {
        var _token = $('meta[name=csrf-token]').attr('content');
        var coin_amount = $('#coin_amount').val();
        if(coin_type == "btc"){
            $('.tb-title').removeClass('eth-color');
            $('.tb-title').addClass('btc-color');
            $('#title1').html("Bitcoin from BTC Trade");
            $('#title2').html("Bitcoin To BTC Trade");
        }else{
            $('.tb-title').removeClass('btc-color');
            $('.tb-title').addClass('eth-color');
            $('#title1').html("Etherium from ETH Trade");
            $('#title2').html("Etherium To ETH Trade");
        }
        $.post('getmytrade', {coin_type:coin_type, _token:_token, flag: flag }, function(resp) {
            var arr = resp.split('@@@');
            $('#buy_list').empty();
            $('#sell_list').empty();
            if ( seemore_flag == -1 ) {
                $('#buy_list').html(arr[0]);
                $('#sell_list').html(arr[1]);
            }
            else if ( seemore_flag == 1 ) {                
                $('#buy_list').html(arr[0]);
            }
            else {
                $('#sell_list').html(arr[1]); 
            }
        } );
    }
}  

$(document).ready(function(){
    j_obj = new CStandard();
    j_obj.init();

    $('#btn_send_email').click(function(){
        $.post('reportuser', {content: $('#report_user_content').val(), _token: $('meta[name=csrf-token]').attr('content')}, function(resp){
            // alert("");
        });
    });
});