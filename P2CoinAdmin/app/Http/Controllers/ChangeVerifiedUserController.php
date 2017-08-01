<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Common;

class ChangeVerifiedUserController extends Controller
{
    //
    public function index() {
        $model = new Common();
        $userlist = $model->getUserList();
        return view('changeverified.index')->with(['userlist'=>$userlist]);
    }
    public function changestatus(Request $request) {
        $user_id = $request->user_id;
        $status = $request->status;
        $type = $request->type;
        $model = new Common();
        dd($model->updateUserVerification( $user_id, $type, $status ));
dd($user_id, $status);        
    }
}
