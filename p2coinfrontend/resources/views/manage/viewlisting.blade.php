@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row text-left">
        <div class="col-md-12 text-center">
            <h3 class="h-title">View Listing</h3>
        <div>
        <div class="col-sm-12 text-left">
            <label class="control-label col-sm-4" for="location">Coin Type</label>
            {{ $listing->coin_type }}
        </div>
        <div class="col-sm-12 text-left"> 
            <label class="control-label col-sm-4" for="coinamount">Coin Amount</label>
            {{ $listing->coin_amount}} 
        </div>
        <div class="col-sm-12">
            <label class="control-label col-sm-4" for="location">Location</label>
            {{ $listing->location }}
        </div>
        <div class="col-sm-12"> 
            <label class="control-label col-sm-4" for="payment_method">Payment Method</label>
            {{ $listing->payment_method }}
        </div>
        <div class="col-sm-12"> 
            <label class="control-label col-sm-4" for="payment_name">Payment Name</label>
            {{ $listing->payment_name }}
        </div>
        <div class="col-sm-12"> 
            <label class="control-label col-sm-4" for="min_transaction_limit">Minimum Transaction Limit</label>
            {{ $listing->min_transaction_limit }} - {{ $listing->max_transaction_limit }} {{ $listing->currency }}
        </div>
        <div class="col-sm-12"> 
            <label class="control-label col-sm-4" for="terms_of_trade">Terms of Trade</label>
            {{ $listing->terms_of_trade }}
        </div>
        <div class="col-sm-12"> 
            <label class="control-label col-sm-4" for="payment_details">Payment Details</label>
            {{ $listing->payment_details }}
        </div>
    </div>
</div>
@endsection
