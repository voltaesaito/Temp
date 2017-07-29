@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="./public/assets/phone/css/intlTelInput.css">
<link rel="stylesheet" href="./public/assets/phone/css/demo.css">
<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-8 col-xs-12">
            <div class="panel-heading">
                <h3 class="h-title">Verify Phone Number</h3>
            </div>
            <form class="form-horizontal" role="form" method="POST" action="{{ route('changepersonphonenumber') }}">
                {{ csrf_field() }}

                <div class="row" >
                    <div class="col-md-12"><label>P2Coin will send you a PIN code to verify your phone.</label></div>
                    <div class="col-md-6 col-sm-8 col-xs-12"><input id="phone"  class="form-control" type="tel"></div>
                    <div class="col-md-2"><button type="button" id="btn_request_code" class="btn btn-success btn-green">Request Code</button></div>
                </div>
                <div class="form-group">
                    <label for="usr">Recieve verification code by Text(SMS).</label>
                </div>
                <div class="form-group">
                    <label for="code">Enter the 6-digit verification code sent to your phone</label>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control col-md-8" id="code">
                </div>
                <input id="phone_number" name="phone_number" type="hidden" value=""> 
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-success btn-green">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="./public/assets/phone/js/intlTelInput.js"></script>
<script src="./public/js/verify/index.js"></script>
<script src="./public/js/verify/changephone.js"></script>
@endsection