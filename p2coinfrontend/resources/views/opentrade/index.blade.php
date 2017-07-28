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
        .th-title {
            font-size:18px;
            font-weight: bold;
        }
    </style>
    <div class="container">
        {{ csrf_field() }}
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Open Trades</h3>
                </div>
                <div class="col-md-12 text-center">
                    <div class="col-md-12 title-content-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center th-title" width="10%">ID</th>
                                    <th class="text-center th-title" width="10%">Seller</th>
                                    <th class="text-center th-title" width="20%;">Amount(coin)</th>
                                    <th class="text-center th-title" width="15%">Amount(fiat)</th>
                                    <th class="text-center th-title" width="15%">Method</th>
                                    <th class="text-center th-title" width="15%">Status</th>
                                    <th class="text-center th-title" width="15%">Trade Opened</th>
                                </tr>
                                </thead>
                                <tbody id="btc_list">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{--<script src="{{ asset('./assets/jquery-1.10.2.min.js') }}"></script>--}}
    {{--<script src="{{URL::asset('./js/wallet/index.js')}}" ></script>--}}
@endsection
