<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WithdrawalsController extends Controller
{
    //
    public function index() {
        return view('withdrawals.index');
    }
}
