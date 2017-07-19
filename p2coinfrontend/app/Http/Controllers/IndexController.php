<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index(Request $request){
        try{
            $request_location_info = json_decode($request->location_info);
            $locationInfo = array('ip'=>$request_location_info->ip,
                                'city'=>$request_location_info->city,
                                'region'=>$request_location_info->region,
                                'country'=>$request_location_info->country,
                                'loc'=>$request_location_info->loc,
                                'org'=>$request_location_info->org,
                                /*'postal'=>$request_location_info->postal*/);
            // dd($locationInfo);
            return view('index.index')->with('country', $locationInfo['country']);
        }
        catch( Exception $e ){
            return redirect()->route("/");
        }
        
    }    
 
}
