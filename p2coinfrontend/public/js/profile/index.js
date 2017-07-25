$(document).ready(function(){
    $.get( "https://chain.so/api/v2/get_info/ETH", function( response ) {
        console.log(response);
    }, "json" );

    $.get('https://api.etherscan.io/api?module=account&action=balance&address=0xddbd2b932c763ba5b1b7ae3b362eac3e8d40121a&tag=latest&apikey=YourApiKeyToken', function(resp){
        console.log(resp);
    })
});