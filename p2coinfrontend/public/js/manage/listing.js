$(document).ready(function() {

    if ( json_listing != 'NULL' ) {
        $('#id').val(json_listing['id']);

        //select value
        $('#user_type').val(json_listing['user_type']);
        $('#coin_type').val(json_listing['coin_type']);
        $('#location').val(json_listing['location']);
        $('#payment_method').val(json_listing['payment_method']);
        $('#currency').val(json_listing['currency']);

        //input value
        var coin_amount = json_listing['coin_amount'];
        var rep_val = (parseFloat(coin_amount * 1 + coin_amount * 0.005)).toFixed(6);
        $('#coin_amount').val(json_listing['coin_amount']);
        $('#fee_amount').val(rep_val);
        $('#payment_name').html(json_listing['payment_name']);
        $('#terms_of_trade').html(json_listing['terms_of_trade']);
        $('#payment_details').html(json_listing['payment_details']);
        $('#min_transaction_limit').val(json_listing['min_transaction_limit']);
        $('#max_transaction_limit').val(json_listing['max_transaction_limit']);
        $('#price_equation').val(json_listing['price_equation']);
    }
//console.log(json_listing,( json_listing == 'NULL' ));
    $( "#coin_amount" ).keyup(function() { 
         if($.isNumeric($( "#coin_amount" ).val())){
            var val = $( "#coin_amount" ).val();
            var val_arr = val.toString().split('.');
            if(val_arr[val_arr.length-1].length > 6){
                slice_str = val.slice(0, val.length-1);
                $( "#coin_amount" ).val(slice_str);
                var rep_val = (parseFloat(slice_str * 1 + slice_str * 0.005)).toFixed(6);
            }else{
                var rep_val = (parseFloat(val * 1 + val * 0.005)).toFixed(6);
            }
            $( "#fee_amount" ).val(rep_val);
         }else{
            alert("Must be Number!");
            $( "#coin_amount" ).val('');
         }
    });

});