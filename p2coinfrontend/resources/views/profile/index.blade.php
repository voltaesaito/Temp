@extends('layouts.app')
@section('content')
<style>
    .margin-height { height: 35px;}
    .trade .title th {font-family: Roboto Boldd; color: #000 !important;}
    .table td {font-family: Roboto Regular; color: #818181 !important; text-align:center;}
    .btc-color { background-color: #00b8e6; }
    .eth-color { background-color: #028840; }
    .btn-grey {
        color: grey;
        font-weight: bold;
        background-color: rgba(37, 157, 109, 0.01);
        border: 2px solid grey !important;
    }
    .div_cell {
        border: lightgrey solid 1px!important;
        color: #028840;
    }
    .gray-title {
        color:gray!important;
    }
</style>
<meta name="csrf-token" content="{{ Session::token() }}"> 
<div class="row">
    <div class="container">
        <h3><strong>Profile: </strong><label id="span_title" class=" gray-title">{{ \Auth::user()->name }}</label></h3>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <label class="col-md-4">Trader Status</label>
                    <label class="col-md-4 gray-title" id="div_trader_status">Online</label>
                </div>
                <div class="row">
                    <label class="col-md-4">Trades</label>
                    <label class="col-md-4 gray-title" id="div_trades">{{ $trade_count }}</label>
                </div>
                <div class="row">
                    <label class="col-md-4">Trade Volume</label>
                    <label class="col-md-4 gray-title" id="div_trade_volume">${{ $trades }}</label>
                </div>
                <div class="row">
                    <label class="col-md-4">Feedback Score</label>
                    <label class="col-md-4 gray-title" id="div_feedback_score">0%</label>
                </div>
                <div class="row">
                    <label class="col-md-4">Trader Age</label>
                    <label class="col-md-4 gray-title" id="div_trader_age">{{ $trader_age }}</label>
                </div>
                <div class="row">
                    <label class="col-md-4">Language</label>
                    <label class="col-md-4 gray-title" id="div_language">{{ "English" }}</label>
                </div>
                <div class="row">
                    <label class="col-md-4">Phone Verified</label>
                    <label class="col-md-4 gray-title" id="div_phone_verify">
                        @if ( Auth::user()->phone_verify == 0 )
                            <strong class="security-level-weak">no</strong>
                        @else
                            <strong class="security-level-strong">yes</strong>
                        @endif
                    </label>
                </div>
                <div class="row">
                    <label class="col-md-4">ID Verified</label>
                    <label class="col-md-4 gray-title" id="div_id_verify">
                        @if ( Auth::user()->id_verify == 0 )
                            <strong class="security-level-weak">no</strong>
                        @else
                            <strong class="security-level-strong">yes</strong>
                        @endif
                    </label>
                </div>
                <div class="row">
                    <label class="col-md-4">Blocked by</label>
                    <label class="col-md-4 gray-title" id="div_blocked_by">0</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center">
                    <a href="#div_feedback" class="menu-caption" data-toggle="collapse">View Feedback</a>
                    <div id="div_feedback" class="collapse">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12"><label><strong>Feedback: </strong>{{ $user->name }}</label></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 text-center"><label><strong>Positive</strong><br>{{ $feedbackinfo['total'][1] }}</label></div>
                                    <div class="col-md-4 text-center"><label><strong>Neutral</strong><br>{{ $feedbackinfo['total'][0] }}</label></div>
                                    <div class="col-md-4 text-center"><label><strong>Negative</strong><br>{{ $feedbackinfo['total'][-1] }}</label></div>
                                </div>
                                <label>Feedback<br></label>
                                <div class="row">                                   
                                    <div class="col-md-2 text-center div_cell"><label>Date</label></div>
                                    <div class="col-md-2 text-center div_cell"><label>User</label></div>
                                    <div class="col-md-2 text-center div_cell"><label>Outcome</label></div>
                                    <div class="col-md-6 text-center div_cell"><label>Feedback</label></div>
                                </div>
                                <div id="feedback_content" >
                                @foreach( $feedbackinfo['data'] as $data )
                                    <div class="row">                                   
                                        <div class="col-md-2 text-center div_cell"><label>{{ $data['date'] }}</label></div>
                                        <div class="col-md-2 text-center div_cell"><label>{{ $data['user'] }}</label></div>
                                        <div class="col-md-2 text-center div_cell"><label>{{ $data['outcome'] }}</label></div>
                                        <div class="col-md-6 text-center div_cell"><label>{{ $data['feedback'] }}</label></div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
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
                <div class="col-md-12 title-content-body">
                    <table class="table table-bordered trade">
                        <thead>
                            <tr class="tb-title">
                                <th class="text-center" colspan = '5' style="color: white; font-size: 24px;">
                                    Buy <font id="title1"></font>
                                </th>
                            </tr>
                            <tr class="title">
                                <th class="menu-caption text-center">Vendor</th>
                                <th class="menu-caption text-center">Payment Method</th>
                                <th class="menu-caption text-center">Price</th>
                                <th class="menu-caption text-center">Limits</th>
                                <th class="menu-caption text-center">View</th>
                            </tr>
                        </thead>
                        <tbody id="buy_list">
                        </tbody>
                    </table>
                </div>
                <!-- <div class="col-md-12 text-center">
                    <button class="btn btn-grey see-more" prop="1">See More</button>
                </div> -->
            </div>
            <div class="margin-height"></div>
            <div class="row">
                <div class="col-md-12 title-content-body">
                    <table class="table table-bordered trade">
                        <thead>
                            <tr class="tb-title">
                                <th class="text-center" colspan = '5' style="color: white; font-size: 24px;">
                                    Sell <font id="title2"></font>
                                </th>
                            </tr>
                            <tr class="title">
                                <th class="menu-caption text-center">Vendor</th>
                                <th class="menu-caption text-center">Payment Method</th>
                                <th class="menu-caption text-center">Price</th>
                                <th class="menu-caption text-center">Limits</th>
                                <th class="menu-caption text-center">View</th>
                            </tr>
                        </thead>
                        <tbody id="sell_list">
                        </tbody>
                    </table>
                </div>
                <!-- <div class="col-md-12 text-center">
                    <button class="btn btn-grey see-more" prop="0">See More</button>
                </div> -->
            </div>

        </div>
        {{--<div class="container">--}}
            {{--<div>{{ $user->name }}</div>--}}
            {{--<div>{{ $user->email }}</div>--}}
            {{--<div>{{ $wallet_address }}</div>--}}
        {{--</div>    --}}
    </div>
</div>
<script src="{{URL::asset('./js/profile/index.js')}}" ></script>
@endsection
