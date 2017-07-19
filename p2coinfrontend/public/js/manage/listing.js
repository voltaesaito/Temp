$(document).ready(function() {
    $('#user_type').change(function() {
        var str = $('#user_type').val();
        if(str == "0"){
            $('#coin_amount').removeAttr('readonly');
            $('#fee_amount').removeAttr('readonly');
            $('#wallet_address').removeAttr('readonly');
        }else{
            $('#coin_amount').attr('readonly', true);
            $('#fee_amount').attr('readonly', true);
            $('#wallet_address').attr('readonly', true);
        }
    });

    $( "#coin_amount" ).keyup(function() {
         if($.isNumeric($( "#coin_amount" ).val())){
            var val = $( "#coin_amount" ).val();
            var val_arr = val.toString().split('.');
            if(val_arr[val_arr.length-1].length > 6){
                slice_str = val.slice(0, val.length-1);
                $( "#coin_amount" ).val(slice_str);
                var rep_val = parseFloat((slice_str * 0.995).toFixed(6));
            }else{
                var rep_val = parseFloat((val * 0.995).toFixed(6));
            }
            $( "#fee_amount" ).val(rep_val);
         }else{
            alert("Must be Number!");
            $( "#coin_amount" ).val('');
         }
    });
});