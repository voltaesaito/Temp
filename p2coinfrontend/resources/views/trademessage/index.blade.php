@extends('layouts.app')
<link href="//fonts.googleapis.com/css?family=Karla:400,700,400italic,700italic&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css">
<link href="//fonts.googleapis.com/css?family=Oswald:400,300,700&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css">
<style>
.terms { 
    min-height: 300px;
}
.pad { padding: 15px; }
.left-content { margin-right: 50px; }
.right-content { margin-left: 50px; }
</style>
@section('content')
<meta name="csrf-token" content="{{ Session::token() }}"> 
<script>var contract_id={{ $contract_id }}</script>
<script>var sender_id={{ $sender_id }}</script>
<script>var receiver_id={{ $receiver_id }}</script>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">ChatRoom</div>


                <div class="panel-body">
                    <h3 class="text-center">
                        <b>Cantract ID : {{ $contract_id }}</b>
                    </h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class = "panel panel-default terms">
                                <div class="pad">
                                    <h4 class="text-center"><b>Payment Terms</b></h4>
                                    <p>Paymentayment Terms</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class = "panel panel-default terms">
                                <div class="pad">
                                    <h4 class="text-center"><b>Payment Details</b></h4>
                                    <p>Paymentayment Terms</p>
                                </div>
                            </div>
                         </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="chat-content"></textarea>
                    </div>
                    <button type="button" id="message_send" class="btn btn-default">SEND</button>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class = "panel panel-default">
                                <div class="pad" id="ajax_message">
                                    @foreach( $data as $msg_content )
                                        <div class="alert alert-{{$msg_content['user_state']}}">
                                            <strong>{{ $msg_content['created_at'] }}</strong><br>
                                            <p>{{ $msg_content['message_content'] }}</p>
                                        </div>
                                    @endforeach 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{--<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>--}}
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>-->
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
<script src="{{ asset('./assets/jquery-1.10.2.min.js') }}"></script>
<script src="{{ asset('js/trademessage/index.js') }}"></script>