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
<script>var listing_id={{ $listing_id }}</script>
<script>var transaction_id={{ $transaction_id }}</script>

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
                                    <p class="pad">{{ $listing['terms_of_trade'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class = "panel panel-default terms">
                                <div class="pad">
                                    <h4 class="text-center"><b>payment_details</b></h4>
                                    <p class="pad">{{ $listing['payment_details'] }}</p>
                                </div>
                            </div>
                         </div>
                    </div>
                    <div class="row" style="overflow-y: scroll; max-height: 300px;">
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
                    <div class="form-group">
                        <textarea class="form-control" id="chat-content"></textarea>
                    </div>
                    <div class="form-group text-right">
                        <button type="button" id="message_send" class="btn btn-success">SEND</button>
                    </div>
                    <div class="form-group">
                        <button type="button" id="release_transaction" class="btn btn-success btn-green">Confirm Transaction</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('./assets/jquery-1.10.2.min.js') }}"></script>
<script src="{{ asset('./js/trademessage/index.js') }}"></script>
@endsection
