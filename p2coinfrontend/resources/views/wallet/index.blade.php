@extends('layouts.app')
@section('content')
<style>
    th,td{
        text-align: center;
    }
    form {
        padding:20px;
    }
    .pull-center {
        text-align: center;
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
                                <td><a href="#" class="a-wallet" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal_deposit" deposit_address="{{ $wallet['address']  }}" prop = "deposit" cointype="{{ $wallet['abbrev'] }}">Deposit {{ $wallet['abbrev'] }}</a></td>
                                <td><a href="#" class="a-wallet" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal_withdraw" prop = 'withdraw' cointype="{{ $wallet['abbrev'] }}">Withdraw {{ $wallet['abbrev'] }}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
<div id="modal_deposit" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pull-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Deposit&nbsp;<label id="coin_string"></label></h4>
                <h5 class="modal-title" id="modal_title"></h5>
            </div>
            <div class="modal-body">
                <form class="form">
                    <div class="form-group pull-center">
                        <label for="label_address" id="label_address"></label>
                        <img src="" id="img_qrcode" width="300px" height="300px" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                {{--<button type="button" class="btn btn-default" id="btn_deposit">Deposit</button>--}}
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>--}}
            </div>
        </div>

    </div>
</div>
<div id="modal_withdraw" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Withdraw</h4>&nbsp;<label id="coin_string"></label>
            </div>
            <div class="modal-body">
                <label>To withdraw <span id="crypto_currency"></span>, please enter the details:</label><br/>
                <label> Note: This is not reversible!</label>
                <form class="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="dest_address">Withdrawal address:</label>
                        <input type="text" class="form-control" id="dest_address">
                    </div>
                    <div class="form-group">
                        <label for="coin_amount">withdrawal:</label>
                        <input type="number" class="form-control" id="coin_amount">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_withdraw">Withdraw</button>
            </div>
        </div>

    </div>
</div>
<script src="{{ asset('./assets/jquery-1.10.2.min.js') }}"></script>
<script src="{{URL::asset('./js/wallet/index.js')}}" ></script>
@endsection
