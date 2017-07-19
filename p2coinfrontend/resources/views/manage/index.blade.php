@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h3 class="h-title">Manage Listings</h3>
        <div>
        <div class="col-sm-offset-9 col-sm-3">
            <a href="{{ route('editlistings') }}" class="btn btn-success btn-green" >+Add Listing</a>
        </div>
        <div class="col-md-12">
            <h3 class="h-title text-center title-border-bottom">Bitcoin:</h3>
        </div>
        <div class="col-md-12 title-content-body">
            <div class="table-responsive">          
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th class="menu-caption text-center">#</th>
                            <th class="menu-caption text-center">Edit</th>
                            <th class="menu-caption text-center">Description</th>
                            <th class="menu-caption text-center">Price</th>
                            <th class="menu-caption text-center">Equation</th>
                            <th class="menu-caption text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($listings as $listing)
                        @if($listing['coin_type'] == 'btc')
                        <tr>
                            <td>#</td>
                            <td>Edit</td>
                            <td>{{ $listing['payment_method'] }} - {{ $listing['payment_name'] }}</td>
                            <td>{{ $listing['min_transaction_limit'] }} - {{ $listing['max_transaction_limit'] }}</td>
                            <td>{{ $listing['price_equation'] }}</td>
                            <td>Status</td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <button class="btn btn-success btn-green">See More</button>
        </div>
        <div class="col-md-12">
            <h3 class="h-title text-center title-border-bottom">Ethereum:</h3>
        </div>
        <div class="col-md-12 title-content-body">
            <div class="table-responsive">          
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th class="menu-caption text-center">#</th>
                            <th class="menu-caption text-center">Edit</th>
                            <th class="menu-caption text-center">Description</th>
                            <th class="menu-caption text-center">Price</th>
                            <th class="menu-caption text-center">Equation</th>
                            <th class="menu-caption text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($listings as $listing)
                        @if($listing['coin_type'] == 'eth')
                        <tr>
                            <td>#</td>
                            <td>Edit</td>
                            <td>{{ $listing['payment_method'] }} - {{ $listing['payment_name'] }}</td>
                            <td>{{ $listing['min_transaction_limit'] }} - {{ $listing['max_transaction_limit'] }}</td>
                            <td>{{ $listing['price_equation'] }}</td>
                            <td>Status</td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <button class="btn btn-success btn-green">See More</button>
        </div>
    </div>
</div>
@endsection