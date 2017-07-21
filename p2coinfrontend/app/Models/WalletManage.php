<?php
/***
    *** This is the class to manage wallet.
*/
namespace App\Models;

use App\Exceptions\BlockIo;
class WalletManage
{
    //
    private $apiKey;
    private $version;
    private $pin;
    private $server_wallet = '3DXwAdsKp1em1nPS4xjv6kNY5FtvvyyBzK';
    private $block_io;

    public function __construct() {
        $this->apiKey = env('BLOCKIO_BITCOIN_APIKEY');
        $this->pin = env('BLOCKIO_PIN');
        $this->version = env('BLOCKIO_VERSION');
        $this->block_io = new BlockIo($this->apiKey, $this->pin, $this->version);
    }
    public function getInstance() {
        return $this->block_io;
    }
    public function getPinCode() {
        return $this->pin;
    }
    public function generateWallet( $label_arr = null ){
        if ( $label_arr == null )
            $ret_Obj = $this->block_io->get_new_address();
        else
            $ret_Obj = $this->block_io->get_new_address($label_arr);
        $wallet_arr = array();
        if ( $ret_Obj->status =='fail' ) return $wallet_arr;
        foreach( $ret_Obj->data as $key=>$val ) {
            $wallet_arr[$key] = $val;
        }
        return $wallet_arr;
    }
    public function getWalletBalanceByAddress( $wallet_address ) {
        return $this->block_io->get_address_balance(array('address'=>$wallet_address));
    }
    public function getWalletBalanceByLabel( $wallet_address_label ) {
        return $this->block_io->get_address_balance(array('label'=>$wallet_address_label));
    }
    public function getCurrentPrice() {
        return $this->block_io->get_current_price();
    }
    public function sendCoin($amount, $from_address, $to_address) {
        // $sendAmount = bcmul($amount, '0.001', 8);
// dd($amount, $sendAmount);
        $estNetworkFee = $this->block_io->get_network_fee_estimate(array('amounts' => $amount, 'to_addresses' => $to_address));
// dd($estNetworkFee);
        //dd($sendAmount, $estNetworkFee);
        $this->block_io->withdraw_from_addresses(array('amounts'=>strval($amount), 'from_addresses'=>$from_address, 'to_addresses'=>$to_address, 'pin'=>$this->pin));
    }
    public function deposit($amount, $userWallet) {
        self::sendCoin($amount, $userWallet, $this->server_wallet);
    }
    public function withdraw($amount, $userWallet) {
//  dd($amount, $this->server_wallet, $userWallet);        
        self::sendCoin($amount, $this->server_wallet, $userWallet);
    }
}
