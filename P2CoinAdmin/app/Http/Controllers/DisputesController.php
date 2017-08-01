<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Common;

class DisputesController extends Controller
{
    //
    public function index() {
        return view('disputes.index');
    } 
}
