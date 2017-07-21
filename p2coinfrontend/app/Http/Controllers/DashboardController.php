<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WalletManage;
class DashboardController extends Controller
{
    //
    public function index() {
        return view('index.dashboard');
    }
}
