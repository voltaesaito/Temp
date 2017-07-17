<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerifyPhoneController extends Controller
{
    //
    public function index() {
        return view('verify.phone');
    }
}
