<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TradeMessageModel;

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
    public function index()
    {
        $contract_id = 1;
        $data = $this->getMsgListByContractId($contract_id);
        //dd($data);
        return view('trademessage.index')->with('data', $data)->with('contract_id', 1)->with('sender_id', 1)->with('receiver_id', 2);
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

    private function getMsgListByContractId( $contract_id ) {
        $datas = TradeMessageModel::all()->where('contract_id', '=', $contract_id)->sortByDesc('created_at');
        $arr = array();
        $user = \Auth::user();
        $current_id = 1;
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
