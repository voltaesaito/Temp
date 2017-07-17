$(document).ready(function() {
    $('#payment_method').change(function() {
        // $(this).val() will work here
        var str = $('#payment_method').val();
        if(str == "sell"){
            $('#cointype').show();
            $('#walletaddress').show();
        }else{
            $('#cointype').hide();
            $('#walletaddress').hide();
        }
    });
});