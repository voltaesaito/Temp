/**
 * Created by administrator on 7/26/17.
 */
function CStandard() {
    this.coin_type = 'eth';
}
CStandard.prototype = {
    init : function() {
        this.initEvent();
    },
    initEvent : function () {
        $('a.a-wallet').click(cObj.doOnClickWalletAction);
        $('#btn_deposit').click(cObj.doOnWalletDeposit);
    },
    doOnClickWalletAction : function () {
        cObj.coin_type = $(this).attr('prop');
    },
    doOnWalletDeposit : function() {
        var src_address = $('#src_address').val();
        var deposit_amount = $('#deposit_amount').val();
        var private_key = $('#private_key').val();
        var _token = $('meta[name=csrf-token]').attr('content');
        var post_param = { src_address: src_address, deposit_amount: deposit_amount, private_key: private_key, coin_type: cObj.coin_type,  _token: _token };
        $.post('deposit', post_param, function(resp) {

        });
    }
}
$(document).ready(function(){
    cObj = new CStandard();
    cObj.init();
});