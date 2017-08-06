<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerifyIDController extends Controller
{
    //
    public function index() {
        return view('auth.verifyid');
    }
    public function uploadidimage(Request $request) {
        // if ($request->file('images')->isValid()) {
            $files = $request->file('images');
            // $path = $request->images->path();
foreach($files as $file){
var_dump(print_r($file, true));
}
            // $extension = $request->images->extension();
dd($files);            
        // }
dd('asdasd');
        return 'Upload successful!';
    }
}
