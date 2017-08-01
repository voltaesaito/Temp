<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Common;

class UserControlController extends Controller
{
    //
    public function index() {
        $model = new Common();
        $userlist = $model->getUserList();
        return view('usercontrol.usercontrol')->with('userlist', $userlist);
    }
    public function getuserbysearch(Request $request) {
        $user_name = $request->user_name;
        $user_email = $request->user_email;
        $model = new Common();
        $userlist = $model->getUserList($user_email, $user_name);
        
        echo json_encode($userlist);
        exit;
    }
    public function userdetail($userid) {
        $model = new Common();
        $userInfo = $model->getUserInfoById($userid);
        $userInfo['user_status'] = 'Active';
        $userInfo['ip_address'] = '23.54.76.39';
        return view('usercontrol.userdetail')->with('user_info', $userInfo);
    }
}
