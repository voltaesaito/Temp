/**
 * Created by administrator on 7/25/17. Paste js/trade/index.js
 */
var seemore_flag = -1;
function JObject() {
}
JObject.prototype = {
    init : function() {

        this.initEventListen();
        this.loadListingData(1);
        this.getLastMessageList();
    },
    initEventListen : function () {
        $('#search-btn').click(j_obj.doOnClickSearchButtonClick);
        $('button.see-more').click(j_obj.doOnSetSeeMoreFlag);
        $('a.view-message').click(j_obj.doViewMessage);
        $('.menu-currency').click(j_obj.dochangecoin)
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
    doOnClickSearchButtonClick : function (seemore_flag) {
        j_obj.loadListingData(0,seemore_flag);
        $('#search_form').collapse('hide');
    },
    doOnSetSeeMoreFlag : function() {
        seemore_flag = $(this).attr('prop');
        j_obj.loadListingData(0);
    },
    dochangecoin : function() {
        var coin = $(this).attr('id');
        $('#coin_type').val(coin);
        j_obj.loadListingData(1);
    },
    loadListingData : function (flag) { 
        if(real_location != undefined)
            $('#location').val(real_location);
        else
            $('#location').val('none');
        var _token = $('meta[name=csrf-token]').attr('content');
        var coin_amount = $('#coin_amount').val();
        var coin_type = $('#coin_type').val();
        if(coin_type == "btc")
            $('.tb-title').addClass('btc-color');
        else
            $('.tb-title').addClass('eth-color');
        var location = $('#location').val();
        var payment_method = $('#payment_method').val();
        $.post('getalllistingdata', {coin_amount:coin_amount, coin_type:coin_type, location:location, payment_method:payment_method, _token:_token, flag: flag }, function(resp) {
            var arr = resp.split('@@@');
            if ( seemore_flag == -1 ) {
                $('#title1').html(arr[0]);
                $('#title2').html(arr[0]);
                $('#buy_list').html(arr[1]);
                $('#sell_list').html(arr[2]);
            }
            else if ( seemore_flag == 1 ) {                
                $('#title1').html(arr[0]);
                $('#buy_list').html(arr[1]);
            }
            else {
                $('#title2').html(arr[0]);
                $('#sell_list').html(arr[2]);
            }
            
        } );
    },
    getLastMessageList : function () {
        var _token = $('meta[name=csrf-token]').attr('content');
        $.post('getlastmessagelist', {_token: _token}, function(resp) {
            $('#msg_list').html(resp);
        } );
    }
}

$(document).ready(function(){
    j_obj = new JObject();
    j_obj.init();
});