<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $mUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_token' => base64_encode($data['email'])
        ]);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $verificationid = $mUser['email_token'];
        $msg = "<h1>Your verification is successed.</h1><a href='".$_SERVER['HTTP_HOST']."/verify/email/".$verificationid."' >".$_SERVER['HTTP_HOST']."/verify/email/".$verificationid."</a>";
        mail($data['email'], "Thanks for your signup", $msg, $headers);
        return $mUser;
        //return view('verify.email')->with('email_token', $verificationid);
    }
    /**
     * Handle a registration request for the application.
     *
     * @param $token
     * @return \Illuminate\Http\Response
     */
    public function emailverify($token)
    {
        $user = User::where('email_token',$token)->first();
        $user->verified = 1;
        if($user->save()){
            return view('auth.login');
        }
    }
}
