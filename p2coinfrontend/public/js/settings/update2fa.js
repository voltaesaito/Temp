$(document).ready(function(){
    $('#btn_authorize').click(function(){
        if($('#pin_code').val()=='') return;
        $.get('check2fa?code='+$('#pin_code').val(), function(resp){
            alert(resp);
        });
    });
    
});