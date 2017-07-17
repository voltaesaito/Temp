<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChangeEmailController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        
        return view('change.email');
    }
    public function twofaindex() {
        return view('change.email');
    }
    public function changephone() {
        $user = \Auth::user();
        return view('change.phone')->with('phone_number', $user->phone_number);
    }
    public function changepersonphonenumber(Request $request) {
        try{
            $phone_number = $request->phone_number;
            $user = \Auth::user();
            $user->phone_number = $phone_number;
            $user->save();
        }
        catch(Exception $e){

        }
        return view('change.phone')->with('phone_number', $user->phone_number);
    }
}
