<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use BlockCypher\Client\BlockchainClient;
use BlockCypher\Api\Wallet;
use BlockCypher\Client\WalletClient;
use BlockCypher\Api\AddressList;
use BlockCypher\Client\AddressClient;
use BlockCypher\Client\TXClient;
use BlockCypher\Rest\ApiContext;
use BlockCypher\Auth\SimpleTokenCredential;
use BlockCypher\Api\TXInput;
use BlockCypher\Api\TXOutput;
use BlockCypher\Api\TX;

class BlockchainWalletMng
{
    //
    private $token;
    private $wallet_type = 'eth';
    private $apiContext;
    public function __construct() {
        $this->token = env('CYPHER_TOKEN');
        $this->apiContext = new ApiContext(new SimpleTokenCredential($this->token));
    }
    public function setWalletType( $wallet_type ) {
        $this->wallet_type = $wallet_type;
        $this->apiContext->setCoin($this->wallet_type);
    }
    public function createWallet( $wallet_name=null ) {
        if (!is_null($wallet_name)) {
            $walletName = $wallet_name;
        } else {
            $walletName = self::generateWalletName(); // Default wallet name for samples
        }

        $wallet = new Wallet();
        $wallet->setName($walletName);
        $walletClient = new WalletClient($this->apiContext);

        try {
            $output = $walletClient->create($wallet);
        } catch (Exception $ex) {
            ResultPrinter::printError("Created Wallet", "Wallet", null, $ex);
            exit(1);
        }
        $ret_arr = array('wallet_name'=>$output->getName(), 'token'=>$output->getToken());
        dd($ret_arr);

        return $output;
    }
    public function generateAddress() {
        $addressClient = new AddressClient($this->apiContext);
        try {
            $addressKeyChain = $addressClient->generateAddress();
        } catch (Exception $ex) {
            ResultPrinter::printError("Generate Address", "AddressKeyChain", null, null, $ex);
            exit(1);
        }
        $ret_arr = array( 'private'=>$addressKeyChain->getPrivate(), 'public'=>$addressKeyChain->getPublic(), 'address'=>$addressKeyChain->getAddress() );

        return $ret_arr;
    }
    public function getAddressBalance( $address ) {
        $addressClient = new AddressClient($this->apiContext);
        try {
            $addressBalance = $addressClient->getBalance($address);
        } catch (Exception $ex) {
            ResultPrinter::printError("Get Only Address Balance", "Address Balance", $address, null, $ex);
            exit(1);
        }
        $ret_arr = array('address'=>$addressBalance->getAddress(),
                         'total_received'=>$addressBalance->getTotalReceived(),
                         'total_sent'=>$addressBalance->getTotalSent(),
                         'balance'=>$addressBalance->getBalance(),
                         'unconfirmed_balance'=>$addressBalance->getUnconfirmedBalance(),
                         'final_balance'=>$addressBalance->getFinalBalance(),
                         'n_tx'=>$addressBalance->getNTx(),
                         'unconfirmed_n_tx'=>$addressBalance->getUnconfirmedNTx(),
                         'final_n_tx'=>$addressBalance->getFinalNTx());
        return $ret_arr;
    }
    public function Transaction($from_address, $to_address, $amount) {
//        $tmp = '{"inputs":[{"addresses": ["add42af7dd58b27e1e6ca5c4fdc01214b52d382f"]}],"outputs":[{"addresses": ["884bae20ee442a1d53a1d44b1067af42f896e541"], "value": 4200000000000000}]}';
//        dd(json_decode($tmp));
        // https://api.blockcypher.com/v1/eth/main/txs/new?token=YOURTOKENΩ
        $input = new TXInput();
        $input->addAddress($from_address['address']);
        $output = new TXOutput();
        $output->addAddress($to_address['address']);
        $output->setValue($amount); // Satoshis
        $tx = new TX();
        $tx->addInput($input);
        $tx->addOutput($output);
//dd($tx);
        $txClient = new TXClient($this->apiContext);
//dd($tx, $txClient);
        try {
            $output = $txClient->create($tx);
        } catch (Exception $ex) {
            ResultPrinter::printError("Created TX", "TXSkeleton", null, null, $ex);
            exit(1);
        }
        return $output;
    }
    public function makeTransaction($from_address, $to_address, $amount) {
//        $trans = file_get_contents("https://api.blockcypher.com/v1/eth/main/txs/new?token={$this->token}");
//dd($trans);
        $txClient = new TXClient($this->apiContext);
        $privateKeys = array( $from_address['private'] );
dd($this->Transaction($from_address, $to_address, $amount),$privateKeys);
        $txSkeleton = $txClient->sign($this->Transaction($from_address, $to_address, $amount), $privateKeys);

        try {
            $txSkeleton = $txClient->send($txSkeleton);
        } catch (Exception $ex) {
            ResultPrinter::printError("Send Transaction", "TXSkeleton", null, $ex);
            exit(1);
        }
    }
    private function generateWalletName() {
        $length = env('WALLET_NAME_LENGTH');
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
