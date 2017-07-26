/**
 * Created by administrator on 7/26/17.
 */
function CStandard() {
    this.coin_type = '';
}
CStandard.prototype = {
    init : function() {
        this.initEvent();
    },
    initEvent : function () {
        $('a.a-wallet').click(cObj.doOnClickWalletAction);
        $('#deposit').click(cObj.doOnWalletDeposit);
    },
    doOnClickWalletAction : function () {
        $('#deposit').collapse('hide');
        $('#withdraw').collapse('hide');
        cObj.coin_type = $(this).attr('prop');
        $('#'+$(this).attr('prop')).collapse('show');
        console.log($(this).attr('prop')+$(this).attr('cointype'));
    },
    doOnWalletDeposit : function() {
        var src_address = $('#src_address');
        var deposit_amount = $('#deposit_amount');
        var private_key = $('#private_key');
        var _token = $('meta[name=csrf-token]').attr('content');
        $.post('deposit', { src_address: src_address, deposit_amount: deposit_amount,
            private_key: private_key, coin_type: cObj.coin_type,  _token: _token }, function(resp) {

        });
    }
}
$(document).ready(function(){
    cObj = new CStandard();
    cObj.init();
});