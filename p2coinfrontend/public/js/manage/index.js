var seemore_flag = -1;
function JObject() {
}
JObject.prototype = {
    init : function() {
        this.initEventListen();
        this.loadListingData(1);
    },
    initEventListen : function () {
        $('button.see-more').click(j_obj.doOnSetSeeMoreFlag);
    },
    doOnSetSeeMoreFlag : function() {
        seemore_flag = $(this).attr('prop');
        j_obj.loadListingData(0);
    },
    loadListingData : function (flag) {
        var _token = $('meta[name=csrf-token]').attr('content');
        $.post('getlistingdatabyuser', { flag: flag, _token: _token }, function(resp) {
            var arr = resp.split('@@@');
            if ( seemore_flag == -1 ) {
                $('#btc_list').html(arr[0]);
                $('#eth_list').html(arr[1]);
            }
            else if ( seemore_flag == 'btc' ) {                
                $('#btc_list').html(arr[0]);
            }
            else {
                $('#eth_list').html(arr[1]);
            }
        } );
    }
}

$(document).ready(function() {
    j_obj = new JObject();
    j_obj.init();
});