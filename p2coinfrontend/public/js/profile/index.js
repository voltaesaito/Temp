$(document).ready(function(){
    $.get( "https://chain.so/api/v2/get_info/ETH", function( response ) {
        console.log(response);
    }, "json" );
});