<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepositsController extends Controller
{
    //
    public function index() {
        return view('deposits.index');
    }
}
