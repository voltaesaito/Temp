$(document).ready(function(){

    var Web3 = require('web3');
    var web3 = new Web3(Web3.givenProvider);
    console.log(web3);

    // $.get( "https://chain.so/api/v2/get_info/ETH", function( response ) {
    //     console.log(response);
    // }, "json" );

    // $.get("https://api.blockcypher.com/v1/eth/main/txs/new?token=6a61174e02ed42ffa08c99c6f602a965", function(resp){
    //     console.log(resp);
    // });

    // $.post('https://api.blockcypher.com/v1/eth/main/addrs?token=6a61174e02ed42ffa08c99c6f602a965', function(resp){
    //     console.log(resp);
    //     var address = resp.address;
    //     var private = resp.private;
    //     var public = resp.public;
    //     var post_param = {inputs: [{addresses:['c6eAabb74607D1Cf557AFf8fb63494B271b001fc']}], outputs: [ { addresses:[address], value: 0.004 } ]};
    //     $.post('https://api.blockcypher.com/v1/eth/main/txs/new?token=6a61174e02ed42ffa08c99c6f602a965', post_param, function(response){
    //         console.log(response);
    //     });
//         $.get('https://api.blockcypher.com/v1/eth/main/addrs/'+address+'/balance', function(response){
// console.log(response);
//         });


        // '{"inputs":[{"addresses": ["add42af7dd58b27e1e6ca5c4fdc01214b52d382f"]}],"outputs":[{"addresses": ["884bae20ee442a1d53a1d44b1067af42f896e541"], "value": 4200000000000000}]}' 


//         $.get('https://api.etherscan.io/api?module=account&action=balance&address=0x'+resp.address+'&tag=latest&apikey=GN7T7U7BSCIT5M7FEETAF751YUQQJ5UCHM', function(response){
// console.log(response)
//         });
    // })
});