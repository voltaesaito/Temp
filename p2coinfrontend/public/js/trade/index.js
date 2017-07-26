var seemore_flag = -1;
function JObject() {
}
JObject.prototype = {
    init : function() {
        this.initEventListen();
        this.loadListingData(1);
    },
    initEventListen : function () {
        $('#search-btn').click(j_obj.doOnClickSearchButtonClick);
        $('button.see-more').click(j_obj.doOnSetSeeMoreFlag);
    },
    doOnClickSearchButtonClick : function (seemore_flag) {
        j_obj.loadListingData(0,seemore_flag);
        $('#search_form').collapse('hide');
    },
    doOnSetSeeMoreFlag : function() {
        seemore_flag = $(this).attr('prop');
        j_obj.loadListingData(0);
    },
    loadListingData : function (flag) {
        var _token = $('meta[name=csrf-token]').attr('content');
        var coin_amount = $('#coin_amount').val();
        var coin_type = $('#coin_type').val();
        var location = $('#location').val();
        var payment_method = $('#payment_method').val();
        $.post('getlistingdata', {coin_amount:coin_amount, coin_type:coin_type, location:location, payment_method:payment_method, _token:_token, flag: flag }, function(resp) {
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
    }
}

$(document).ready(function(){
    j_obj = new JObject();
    j_obj.init();
});