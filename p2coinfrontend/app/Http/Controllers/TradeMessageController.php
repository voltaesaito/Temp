<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TradeMessageModel;
use App\Models\Listings;
use Illuminate\Foundation\Auth\User;

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
        $data = $this->getMsgListByContractId($contract_id);

        $listings = listings::all()->where('id', '=', $listing_id);
        foreach($listings as $list){
            $listing = $list;
            break;
        }
        
        return view('trademessage.index')->with('data', $data)->with('listing', $listing)->with('contract_id', $contract_id)->with('sender_id', $sender_id)->with('receiver_id', $receiver_id);
    }
    public function addmessage(Request $request) {
        header('Content-type:application/json');
        
        $contract_id = $request->contract_id;
        $sender_id = $request->sender_id;
        $receiver_id = $request->receiver_id;
        $message_content = $request->message_content;
        $newRow = new TradeMessageModel();
        $newRow->contract_id = $contract_id;
        $newRow->sender_id = $sender_id;
        $newRow->receiver_id = $receiver_id;
        $newRow->message_content = $message_content;
        $newId = $newRow->save();

        $arr = $this->getMsgListByContractId($contract_id);
        echo json_encode($arr);
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

        return redirect()->action(
            'TradeMessageController@index', ['contract_id' => $contract_id, 'sender_id' => $sender_id, 'receiver_id' => $receiver_id, 'listing_id' => $listing_id]
        );    
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
