<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Useridimage;

class VerifyIDController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        return view('auth.verifyid');
    }
    public function uploadidimage(Request $request) {
        $user = \Auth::user();
        if ( $request->hasFile('images') ) {
            foreach( $request->file('images') as $file ) :
                $path = base_path().'/public/uploads/user_infos/'.$user->id.'/';
                $titre = $file->getClientOriginalName();
                $file->move($path, $titre);
                $useridimage = Useridimage::all()->where('user_id', '=', $user->id)->where('image_path', '=', $titre)->first();
                if ( !$useridimage )
                    $useridimage = new Useridimage();
                $useridimage->user_id = $user->id;
                $useridimage->image_path = $titre;
                $useridimage->save();

            endforeach;
        }
        return view('auth.verifyid');
    }
    public function loadidimagebyuser() {
        // $user_id = request()->get('user_id');
$user_id = \Auth::user()->id;
        $path = '/uploads/user_infos/'.$user_id.'/';
        $img_datas = Useridimage::all()->where('user_id', '=', $user_id);
        $img_arr = array();
        foreach( $img_datas as $img_data ) {
            $img_arr[] = array('path'=>$path.$img_data->image_path, 'name'=>$img_data->image_path);
        }
        return view('auth.verifyidcheck')->with(['img_arr'=>$img_arr]);
    }
}
