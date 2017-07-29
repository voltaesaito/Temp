<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ChangeEmailController extends Controller
{
    //
    private $fileName = 'google2fasecret.key';
    private $secretKey;
    private $email = '';

    private $keySize = 32;

    private $keyPrefix = '';
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        
        return view('change.email');
    }
    public function twofaindex() {
        $user = \Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;

        $valid = $this->validateInput($key = $this->getSecretKey());

        $inlineUrl = $this->getInlineUrl($key);

        return view('change.twofaauth')->with(compact('key', 'inlineUrl', 'valid'));
    }
    public function changephone() {
        $user = \Auth::user();
        return view('change.phone')->with('phone_number', $user->phone_number);
    }
    public function changepersonphonenumber(Request $request) {
        try{
            $phone_number = $request->phone_number;
            $user = \Auth::user();
            $user->phone_number = $phone_number;
            $user->save();
        }
        catch(Exception $e){

        }
        return view('change.phone')->with('phone_number', $user->phone_number);
    }
    private function getInlineUrl($key)
    {
        $gCls = new Google2FA();
        return $gCls->getQRCodeInline($this->name,$this->email,$key);
    }
    private function getSecretKey()
    {
        //dd($this->getStoredKey(),(! $key = $this->getStoredKey()));
        if (! $key = $this->getStoredKey())
        {
            $cls = new Google2FA();
            $key = $cls->generateSecretKey($this->keySize, $this->keyPrefix);
//dd($key);
            $this->storeKey($key);
        }

        return $key;
    }
    private function storeKey($key)
    {
        Storage::put($this->fileName, $key);
    }
    private function getStoredKey()
    {
        // No need to read it from disk it again if we already have it
        if ($this->secretKey)
        {
            return $this->secretKey;
        }

        if (! Storage::exists($this->fileName))
        {
            return null;
        }

        return Storage::get($this->fileName);
    }
    private function validateInput($key)
    {
        // Get the code from input
        if (! $code = request()->get('code'))
        {
            return false;
        }
        $gCls = new Google2FA();
        // Verify the code
        return $gCls->verifyKey($key, $code);
    }
    public function check2fa()
    {
        $isValid = $this->validateInput($key = $this->getSecretKey());

        // Render index and show the result
        if ($isValid)
            echo "ok";
        else
            echo "fail";
        exit;
//        return $this->index($isValid);
    }
}
