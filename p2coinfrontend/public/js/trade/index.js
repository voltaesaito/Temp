function JObject() {
}
JObject.prototype = {
    init : function() {
        this.initEventListen();
        this.loadListingData(1);
    },
    initEventListen : function () {
        $('#search-btn').click(j_obj.doOnClickSearchButtonClick);
    },
    doOnClickSearchButtonClick : function () {
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
            $('#title1').html(arr[0]);
            $('#title2').html(arr[0]);
            $('#buy_list').html(arr[1]);
            $('#sell_list').html(arr[2]);
        } );
    }
}

$(document).ready(function(){
    j_obj = new JObject();
    j_obj.init();
});