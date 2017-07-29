$('form').submit(function(){
    $('#phone_number').val($('#phone').val());
});
$(document).ready(function(){
    $('#btn_request_code').click(function(){
        if ( $('#phone').val() == '') return ;
        $.get('getpincode?phone_number='+$('#phone').val(), function(resp){

        });
    });

});