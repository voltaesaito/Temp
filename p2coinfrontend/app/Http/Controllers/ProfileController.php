<?php

namespace App\Http\Controllers;

use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\Models\UserWallet;
use App\Models\Listings;
use App\Models\ContractFeedback;
class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        try {
            $userWalletInfo = new UserWallet();
            $user = \Auth::user();
            $from_date = date_create($user->created_at);
//            $from_date = date_create("2013-01-01");
            $to_date = date_create(date('Y-m-d H:m:s'));
            $diff = date_diff($from_date, $to_date);
//            dd($diff);
            $trader_age = $diff->format("%d days %h hours %i minutes %s seconds");
            // $userWalletAddress = $userWalletInfo->getUserWallet($user->id);

            $listingModel = new Listings();
            $tradeCount = $listingModel->getTradeCount( $user->id, 'btc' );
            $tradeAmount = $listingModel->getTradeAmount( $user->id, 'btc' );
            $price_rate = $userWalletInfo->getCurrentPrice();
            $trades = preg_replace("/\.?0*$/",'',number_format($tradeAmount['btc']*$price_rate['btc']+$tradeAmount['eth']*$price_rate['eth'], 2, '.', ','));

            $feedbackModel = new ContractFeedback();
            // dd($feedbackModel->getFeedbackByUser($user->id));
            return view('profile.index')->with('user', $user)
                ->with(['buy_title'=>'Buy Bitcoins from BTC Trade','sell_title'=>'Sell Bitcoins from BTC Trade', 'trader_age'=>$trader_age, 'trade_count'=>$tradeCount, 'trades'=>$trades])
                ->with('feedbackinfo',$feedbackModel->getFeedbackByUser($user->id, 'btc'));
        }
        catch( Exception $e ) {
            return redirect()->action('/');
        }
    } 

    public function getfeedback() {
        header('Content-type:application/json');
        $coin = request()->get('coin');

        $userWalletInfo = new UserWallet();
        $user = \Auth::user();
        $feedbackModel = new ContractFeedback();
        echo json_encode($feedbackModel->getFeedbackByUser($user->id, $coin));
        
    }

    public function gettrade(Request $request) {
        header('Content-type:application/json');
        $user = \Auth::user();
        $userWalletInfo = new UserWallet();
        $coin = $request->coin;
        $listingModel = new Listings();
        $tradeCount = $listingModel->getTradeCount( $user->id, $coin );
        $tradeAmount = $listingModel->getTradeAmount( $user->id, $coin );
        $price_rate = $userWalletInfo->getCurrentPrice();
        $trades = preg_replace("/\.?0*$/",'',number_format($tradeAmount[$coin]*$price_rate[$coin], 2, '.', ','));
        $ret_arr = array('trades'=>$tradeCount, 'volumes'=>$trades);
        echo json_encode($ret_arr);
        exit;
    }

    public function getMyTrade(Request $request) {

        $flag = $request->flag;
        $user = \Auth::user();
        $lModel = new Listings();

        if($request->flag == true){
            $buy_listings = $lModel->getMyTrade($user->id, 1, 1, $request->coin_type);
            $sell_listings = $lModel->getMyTrade($user->id, 0, 1, $request->coin_type);
        }else{
            $buy_listings = $lModel->getMyTrade($user->id, 1, 0, $request->coin_type);
            $sell_listings = $lModel->getMyTrade($user->id, 0, 0, $request->coin_type);
        }

        $buy_list = "";
        foreach($buy_listings as $listing){
            $buy_list .= "<tr>";
            $buy_list .= "<td>" . $listing->name . "</td>";
            $buy_list .= "<td>" . $listing->payment_method . ": " . $listing->payment_name . "</td>";
            $buy_list .= "<td>" . round($listing->coin_amount, 2) . " USD</td>";
            $buy_list .= "<td>" . $listing->min_transaction_limit . "-" . $listing->max_transaction_limit . " " . $listing->currency . "</td>";
            $buy_list .= "<td>";
            $buy_list .= "<button type='button' onclick=\"j_obj.doViewMessages('" . $listing->cid . "-" . $listing->id . "-" . $user->id . "-" . $listing->user_id . "-1-0')\" class='btn btn-grey view'>View/Message</button>";
            $buy_list .= "</td>";
            $buy_list .= "</tr>";
        }  

        $sell_list = "";
        foreach($sell_listings as $listing){
            $sell_list .= "<tr>";
            $sell_list .= "<td>" . $listing->name . "</td>";
            $sell_list .= "<td>" . $listing->payment_method . ": " . $listing->payment_name . "</td>";
            $sell_list .= "<td>" . round($listing->coin_amount, 5) . " USD</td>";
            $sell_list .= "<td>" . $listing->min_transaction_limit . "-" . $listing->max_transaction_limit . " " . $listing->currency . "</td>";
            $sell_list .= "<td>";
            $sell_list .= "<button type='button' onclick=\"j_obj.doViewMessages('" . $listing->cid . "-" . $listing->id . "-" . $user->id . "-" . $listing->user_id . "-0-0')\" class='btn btn-grey view'>View/Message</button>";
            $sell_list .= "</td>";
            $sell_list .= "</tr>";
        }

        echo $buy_list . "@@@" . $sell_list;
        exit;
    } 
}
