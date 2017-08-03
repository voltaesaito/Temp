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
        $userStatus = $model->getUserStatus($userid);
//        dd($userStatus);
        ( $userStatus->block_account == 0 ) ? $userInfo['block_account_status'] = "checked" : $userInfo['block_account_status'] = '';
        ( $userStatus->block_ip == 0 ) ? $userInfo['block_ip_status'] = "checked" : $userInfo['block_ip_status'] = '';
        $userInfo['block_account'] = $userStatus->block_account;
        $userInfo['block_ip'] = $userStatus->block_ip;
        $userInfo['user_status'] = 'Active';
        $userInfo['ip_address'] = '23.54.76.39';
        return view('usercontrol.userdetail')->with('user_info', $userInfo);
    }
    public function blockuser(Request $request) {
        $user_id = $request->user_id;
        $status = $request->status;
        $type = $request->type;

        $model = new Common();
        echo $model->changeuserBlockStatus($user_id, $type, $status);
        exit;
    }
}