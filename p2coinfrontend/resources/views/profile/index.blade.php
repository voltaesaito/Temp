@extends('layouts.app')
@section('content')
<meta name="csrf-token" content="{{ Session::token() }}"> 
<div class="row">
    <div class="container">
        <h3><strong>Profile:</strong><span id="span_title">BTC</span>Trade</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <label class="col-md-4">Trader Status</label>
                    <label class="col-md-4" id="div_trader_status">Online</label>
                </div>
                <div class="row">
                    <label class="col-md-4">Trades</label>
                    <label class="col-md-4" id="div_trades">{{ $trade_count }}</label>
                </div>
                <div class="row">
                    <label class="col-md-4">Trade Volume</label>
                    <label class="col-md-4" id="div_trade_volume">${{ $trades }}</label>
                </div>
                <div class="row">
                    <label class="col-md-4">Feedback Score</label>
                    <label class="col-md-4" id="div_feedback_score">0%</label>
                </div>
                <div class="row">
                    <label class="col-md-4">Trader Age</label>
                    <label class="col-md-4" id="div_trader_age">{{ $trader_age }}</label>
                </div>
                <div class="row">
                    <label class="col-md-4">Language</label>
                    <label class="col-md-4" id="div_language">{{ "English" }}</label>
                </div>
                <div class="row">
                    <label class="col-md-4">Phone Verified</label>
                    <label class="col-md-4" id="div_phone_verify">
                        @if ( Auth::user()->phone_verify == 0 )
                            <strong class="security-level-weak">no</strong>
                        @else
                            <strong class="security-level-strong">yes</strong>
                        @endif
                    </label>
                </div>
                <div class="row">
                    <label class="col-md-4">ID Verified</label>
                    <label class="col-md-4" id="div_id_verify">
                        @if ( Auth::user()->id_verify == 0 )
                            <strong class="security-level-weak">no</strong>
                        @else
                            <strong class="security-level-strong">yes</strong>
                        @endif
                    </label>
                </div>
                <div class="row">
                    <label class="col-md-4">Blocked by</label>
                    <label class="col-md-4" id="div_blocked_by">0</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center">
                    <a href="#div_feedback" class="menu-caption" data-toggle="collapse">View Feedback</a>
                    <div id="div_feedback" class="collapse">
                        <div class="panel panel-default">
                            <div class="panel-body"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <a href="#div_report_user" class="menu-caption" data-toggle="collapse">Report User</a>
                    <div id="div_report_user" class="collapse">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <label>Why are you reporting this user?</label>
                                <textarea id="report_user_content" class="form-control" rows="5" ></textarea>
                                <br/>
                                <button type="button" class="btn btn-success" id="btn_send_email"> Submit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h4 class="text-center"><strong>Sell Bitcoins from <label id="lbl_sell">BTC</label> Trade</strong></h4>
                <div class="col-md-12 title-content-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center" width="10%">#</th>
                                <th class="text-center" width="10%">Edit</th>
                                <th class="text-center" width="50%;">Discription</th>
                                <th class="text-center" width="15%">Price</th>
                                <th class="text-center" width="15%">Status</th>
                            </tr>
                            </thead>
                            <tbody id="btc_list">
                            </tbody>
                        </table>
                    </div>
                </div>
                <h4 class="text-center"><strong>Buy Bitcoins from <label id="lbl_buy">BTC</label> Trade</strong></h4>
                <div class="col-md-12 title-content-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center" width="10%">#</th>
                                <th class="text-center" width="10%">Edit</th>
                                <th class="text-center" width="50%;">Discription</th>
                                <th class="text-center" width="15%">Price</th>
                                <th class="text-center" width="15%">Status</th>
                            </tr>
                            </thead>
                            <tbody id="btc_list">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="container">--}}
            {{--<div>{{ $user->name }}</div>--}}
            {{--<div>{{ $user->email }}</div>--}}
            {{--<div>{{ $wallet_address }}</div>--}}
        {{--</div>    --}}
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{URL::asset('./js/profile/index.js')}}" ></script>