<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TradeMessageModel;
use App\Models\Listings;
use Illuminate\Foundation\Auth\User;
use DB;
use App\Models\TransactionHistory;
use App\Models\UserWallet;
use App\Models\WalletManage;
use App\Models\BlockchainWalletMng;

class TradeMessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listing_id = $request->listing_id;
        $contract_id = $request->contract_id;
        $sender_id = $request->sender_id;
        $receiver_id = $request->receiver_id;
        $transaction_id = $request->transaction_id;
        $data = $this->getMsgListByContractId($contract_id);

        $listings = listings::all()->where('id', '=', $listing_id);
        foreach($listings as $list){
            $listing = $list;
            break;
        }

        $row = TransactionHistory::all()->where('transaction_id','=',$transaction_id)->first();
        $coin_amount = $row->coin_amount;

        $tmp_data = DB::select("select coin_type from listings where id in ( select c.listing_id from contract c join transaction_history th on th.contract_id=c.id where th.transaction_id={$transaction_id})");
        $tmp = $tmp_data[0];
        $coin_type = $tmp->coin_type;

        $flag = true;
        if ( $coin_type == 'btc' ) {
            $temp_row = UserWallet::all()->where('user_id', '=', $sender_id)->first();
            $sender_wallet = $temp_row->wallet_address;
            $temp_row = UserWallet::all()->where('user_id', '=', $receiver_id)->first();
            $receiver_wallet = $temp_row->wallet_address;

            $model = new WalletManage();
            $data = $model->getTransFee($coin_amount, $receiver_wallet);
            $request_amount = $data['total'];
            $tmp = $model->getWalletBalanceByAddress($sender_wallet);
            $balance = $tmp->data->available_balance;

        }
        if ( $coin_type == 'eth' ) {
            $model = new UserWallet();
            $sender_info = $model->getWalletInfo($sender_id, 'eth');
            $from_address = array('address'=>$sender_info->wallet_address, 'private'=>$sender_info->private, 'public'=>$sender_info->public);
            $receiver_info = $model->getWalletInfo($receiver_id, 'eth');
            $to_address = array('address'=>$receiver_info->wallet_address, 'private'=>$receiver_info->private, 'public'=>$receiver_info->public);
            $wModel = new BlockchainWalletMng();
            $wModel->setWalletType( $coin_type );
            $Skelton = $wModel->createTransaction($from_address, $to_address, $coin_amount);
            $request_amount = floatval(($Skelton->tx->total+$Skelton->tx->fees)/1000000000000000000);
            $tmp = $wModel->getAddressBalance($sender_info->wallet_address);
            $balance = floatval($tmp['final_balance']/1000000000000000000);


        }
        
        return view('trademessage.index')->with('data', $data)->with('transaction_id', $transaction_id)->with('listing', $listing)
            ->with('listing_id', $listing_id)->with('contract_id', $contract_id)->with('sender_id', $sender_id)->with('receiver_id', $receiver_id)
            ->with('request_amount', $request_amount)->with('balance', $balance);
    }

    public function addmessage(Request $request) {
        header('Content-type:application/json');
        
        $contract_id = $request->contract_id;
        $sender_id = $request->sender_id;
        $receiver_id = $request->receiver_id;
        $message_content = $request->message_content;

        if ( $message_content != 'NULL' ) {  
            $newRow = new TradeMessageModel();
            $newRow->contract_id = $contract_id;
            $newRow->sender_id = $sender_id;
            $newRow->receiver_id = $receiver_id;
            $newRow->message_content = $message_content;
            $newId = $newRow->save();
        }
        $arr = $this->getMsgListByContractId($contract_id);
        
        $userWalletModel = new UserWallet();
        $receiver_address = $userWalletModel->getUserWallet($receiver_id);

        $transModel = new TransactionHistory();
        $row = $transModel->getDataByContractId($contract_id);
        $coin_amount = $row->coin_amount;

        $walletModel = new WalletManage();
        $fee = $walletModel->getTransFee($coin_amount, $receiver_address);        

        $senderBalance = $walletModel->getWalletBalanceByAddress($userWalletModel->getUserWallet($sender_id));
        $amount = $senderBalance->data->available_balance;
        ( $amount*1 > $fee['total'] ) ? $fee['status'] = 'enable' : $fee['status'] = 'disable';

        $ret_arr['fee'] = $fee;
        $ret_arr['content'] = $arr;
        echo json_encode($ret_arr);
        exit;
    }

    public function createcontract(Request $request){
        $user = \Auth::user();
        $listing_id = $request->listing_id;
        $contract_id = $request->contract_id;
        $sender_id = $user->id;
        $receiver_id = $request->receiver_id;
        $coin_amount = $request->coin_amount;
        $price = $request->price;
        $message_content = "<strong>BTH : </strong>" . $coin_amount;

        $newRow = new TradeMessageModel();
        $newRow->contract_id = $contract_id;
        $newRow->sender_id = $sender_id;
        $newRow->receiver_id = $receiver_id;
        $newRow->message_content = $message_content;
        $newId = $newRow->save();


        $listing_row = Listings::find($listing_id);
        $coin_sender_id = '';
        if ( $listing_row->user_type == 0 ) {  //sell
            $coin_sender_id = $listing_row->user_id;
            $coin_receiver_id = $user->id;
        }
        else {  //buy
            $coin_sender_id = $user->id;
            $coin_receiver_id = $listing_row->user_id;
        }
        $newRow = new TransactionHistory();
        $newRow->contract_id = $contract_id;
        $newRow->coin_amount = $coin_amount;
        $newRow->coin_sender_id = $coin_sender_id;
        $newRow->coin_receiver_id = $coin_receiver_id;
        $newRow->save();

        $transaction_id = $newRow->id;

        $listings = listings::all()->where('id', '=', $listing_id);
        foreach($listings as $list){
            $listing = $list;
            break;
        }
        $data = $this->getMsgListByContractId($contract_id);

        return view('trademessage.index')->with('data', $data)->with('transaction_id', $transaction_id)->with('listing', $listing)->with('listing_id', $listing_id)->with('contract_id', $contract_id)->with('sender_id', $sender_id)->with('receiver_id', $receiver_id);
    }

    public function messagebox(Request $request){

        //User list
        $user = \Auth::user();
        $user_id = $user->id;
        $sql = "select c.id contract_id, c.sender_id id, u.name name from contract c, users u where c.sender_id = u.id and receiver_id = {$user_id} order by c.id desc";
        $user_list = DB::select($sql);
// dd($sql);      
        //Messages for first user
        $msg_content = array();
        foreach($user_list as $user){
            $msg_content = $this->getMsgListByContractId($user->contract_id);
            break;
        }

// dd($fee);        
        return view('trademessage.messagebox')->with('user_list', $user_list)->with('msg_content', $msg_content);
    }

    private function getMsgListByContractId( $contract_id ) {
        $datas = TradeMessageModel::all()->where('contract_id', '=', $contract_id);
        $arr = array();
        $user = \Auth::user();
        $current_id = $user->id;
        foreach( $datas as $data ) {
            $user_state = 'success left-content';
            if($current_id == $data->sender_id)
                $user_state = 'info right-content';
            $arr[] = array( 'contract_id'       => $data->contract_id,
                            'sender_id'         => $data->sender_id,
                            'receiver_id'       => $data->receiver_id,
                            'message_content'   => $data->message_content,
                            'user_state'        => $user_state,
                            'created_at'        => date('H:m:s M j,Y',strtotime($data->created_at)));
        }
        return $arr;
    }
}
