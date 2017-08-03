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
                                    <th class="text-center th-title">ID</th>
                                    <th class="text-center th-title">Seller</th>
                                    <th class="text-center th-title">Amount(coin)</th>
                                    <th class="text-center th-title">Amount(fiat)</th>
                                    <th class="text-center th-title">Method</th>
                                    <th class="text-center th-title">Status</th>
                                    <th class="text-center th-title">Trade Opened</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sell_listings as $listing)
                                    <tr>
                                        <td>{{ $listing->id }}</td>
                                        <td>{{ $listing->name }}</td>
                                        <td>{{ $listing->coin_amount }}</td>
                                        <td>{{ $listing->coin_amount }}</td>
                                        <td>{{ $listing->payment_method }}</td>
                                        <td>-</td>
                                        <td>{{ $listing->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <div class="col-md-12 title-content-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center th-title">ID</th>
                                    <th class="text-center th-title">Buyer</th>
                                    <th class="text-center th-title">Amount(coin)</th>
                                    <th class="text-center th-title">Amount(fiat)</th>
                                    <th class="text-center th-title">Method</th>
                                    <th class="text-center th-title">Status</th>
                                    <th class="text-center th-title">Trade Opened</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($buy_listings as $listing)
                                    <tr>
                                        <td>{{ $listing->id }}</td>
                                        <td>{{ $listing->name }}</td>
                                        <td>{{ $listing->coin_amount }}</td>
                                        <td>{{ $listing->coin_amount }}</td>
                                        <td>{{ $listing->payment_method }}</td>
                                        <td>-</td>
                                        <td>{{ $listing->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="{{ asset('./assets/jquery-1.10.2.min.js') }}"></script>
@endsection