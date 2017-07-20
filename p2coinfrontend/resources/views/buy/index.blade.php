@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Contract ID : </div>
                <div class="panel-body">
                    <h3 class="text-center">Payment Terms</h3>
                    <div>
                        {{ $listing['terms_of_trade'] }}
                    </div>
                </div>
            </div>
            <div class="panel panel-default text-center">
                <div class="panel-body">
                    <h3>Price : </h3>
                    <div class="panel-body text-center">
                        <div class="col-sm-5"> 
                            <div class="input-group">
                                <input class="numberinput form-control" id="coin_amount" name="coin_amount" type="number"> 
                                <span class="input-group-addon">BTC</span>
                            </div>
                        </div>
                        <div class="col-sm-2"> 
                            <div class="input-group">
                            </div>
                        </div>
                        <div class="col-sm-5"> 
                            <div class="input-group">
                                <input class="numberinput form-control" id="price" name="price" placeholder="0.00" type="number"> 
                                <span class="input-group-addon">USD</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body text-center">
                        <button type="button" class="btn btn-success" style="width: 30%;">BUY</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{URL::asset('./js/buy/index.js')}}" ></script>