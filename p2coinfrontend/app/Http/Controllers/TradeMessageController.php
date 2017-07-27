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
        
        return view('trademessage.index')->with('data', $data)->with('transaction_id', $transaction_id)->with('listing', $listing)->with('listing_id', $listing_id)->with('contract_id', $contract_id)->with('sender_id', $sender_id)->with('receiver_id', $receiver_id);
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
