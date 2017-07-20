$(document).ready(function(){
    var btc = 2542;
    $( "#coin_amount" ).keyup(function() {
         if($.isNumeric($( "#coin_amount" ).val())){
            var val = $( "#coin_amount" ).val();
            var val_arr = val.toString().split('.');
            if(val_arr[val_arr.length-1].length > 6){
                slice_str = val.slice(0, val.length-1);
                $( "#coin_amount" ).val(slice_str);
                var rep_val = parseFloat((slice_str * btc).toFixed(2));
            }else{
                var rep_val = parseFloat((val * btc).toFixed(2));
            }
            $( "#price" ).val(rep_val);
         }
    });
    $( "#price" ).keyup(function() {
         if($.isNumeric($( "#price" ).val())){
            var val = $( "#price" ).val();
            var val_arr = val.toString().split('.');
            if((val_arr[val_arr.length-1].length > 2) && (val_arr.length > 1)){
                slice_str = val.slice(0, val.length-1);
                $( "#price" ).val(slice_str);
                var rep_val = parseFloat((slice_str / btc).toFixed(6));
            }else{
                var rep_val = parseFloat((val / btc).toFixed(6));
            }
            $( "#coin_amount" ).val(rep_val);
         }
    });
});