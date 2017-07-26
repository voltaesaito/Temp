@extends('layouts.app')
@section('content')
<style>
    th{
        text-align: center;
    }
    form {
        padding:20px;
    }
</style>
    <div class="container">
        {{ csrf_field() }}
        <h3>Wallet</h3>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4>Total worth:</h4>
                </div>
                <div class="col-md-12 table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Coin</th>
                            <th>Abbrev</th>
                            <th>Amount</th>
                            <th>Amount in USD</th>
                            <th>Deposit</th>
                            <th>Withdraw</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $wallet_info as $wallet )
                            <tr>
                                <td>{{ $wallet['coin']  }}</td>
                                <td>{{ $wallet['abbrev']  }}</td>
                                <td>{{ $wallet['amount']  }}</td>
                                <td>{{ $wallet['address']  }}</td>
                                <td><a href="#" class="a-wallet" prop = "deposit" cointype="{{ $wallet['abbrev'] }}">Deposit BTC</a></td>
                                <td><a href="#" class="a-wallet" prop = 'withdraw' cointype="{{ $wallet['abbrev'] }}">Withdraw BTC</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <div id="div_deposit" class="panel panel-default">
                        <div class="panel-body">Deposit <span id="crypto_curency"></span></div>
                        <form class="form">
                            <div class="form-group">
                                <label for="src_address">Address:</label>
                                <input type="text" class="form-control" id="src_address" required>
                            </div>
                            <div class="form-group">
                                <label for="private_key">Private:</label>
                                <input type="text" class="form-control" id="private_key" required>
                            </div>
                            <div class="form-group">
                                <label for="wallet_amount">Amount:</label>
                                <input type="text" class="form-control" id="wallet_amount" readonly>
                            </div>
                            <div class="form-group">
                                <label for="deposit_amount">Deposit Amount:</label>
                                <input type="text" class="form-control" id="deposit_amount" required>
                            </div>
                            <button type="button" class="btn btn-default" id="btn_deposit">Deposit</button>
                        </form>
                    </div>
                    {{--<div id="withdraw" class="collapse panel panel-default">--}}
                        {{--<div class="panel-body">Withdraw <span id="crypto_curency"></span></div>--}}
                        {{--<form class="form">--}}
                            {{--{{ csrf_field() }}--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="address">Address:</label>--}}
                                {{--<input type="text" class="form-control" id="address">--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="coin_amount">Amount:</label>--}}
                                {{--<input type="number" class="form-control" id="coin_amount">--}}
                                {{--<label for="coin_amount">Deposit Amount:</label>--}}
                                {{--<input type="number" class="form-control" id="withdraw_amount">--}}
                            {{--</div>--}}
                            {{--<button type="button" class="btn btn-default">Deposit</button>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                </div>
            </div>

        </div>
    </div>
<script src="{{ asset('./assets/jquery-1.10.2.min.js') }}"></script>
<script src="{{URL::asset('./js/wallet/index.js')}}" ></script>
@endsection
