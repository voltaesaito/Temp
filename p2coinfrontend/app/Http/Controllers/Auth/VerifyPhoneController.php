<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use checkmobi\CheckMobiRest;

class VerifyPhoneController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        return view('verify.phone');
    }
    public function getpincode(Request $request){
        $number = $request->phone_number;
        $checkmobi_secret_key = env('CHECKMOBI_SECRET_KEY');
        $api = new CheckMobiRest($checkmobi_secret_key);

        $response = $api->CheckNumber(array('number'=>"+86".$number));
        $resp = $api->SendSMS(array('to'=>"+86".$number, "text"=>'KingGuo'));
        dd($response,$resp);
    }
}
