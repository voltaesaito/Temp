<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteWalletController extends Controller
{
    //
    public function index() {
        return view('websitewallet.index');
    }
}
