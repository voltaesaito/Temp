@extends('layouts.app')

@section('content')
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 47px;
  height: 26px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #f34242;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: 4px;
  bottom: 3px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: green;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(20px);
  -ms-transform: translateX(20px);
  transform: translateX(20px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 24px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<meta name="csrf-token" content="{{ Session::token() }}"> 
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
                            <td>{{ $listing['coin_amount'] }}</td>
                            <td>{{ $listing['price_equation'] }}</td>
                            <td>
                                <label class="switch">
                                @if($listing['status'])
                                    <input type="checkbox" class="status" id="{{ $listing['id'] }}" name="status" checked>
                                @else
                                    <input type="checkbox" class="status" id="{{ $listing['id'] }}" name="status">
                                @endif
                                    <span class="slider round"></span>
                                </label>
                            </td>
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
                <table class="table  text-center">
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
                            <td>
                                <label class="switch">
                                @if($listing['status'])
                                    <input type="checkbox" class="status" id="{{ $listing['id'] }}" name="status" checked>
                                @else
                                    <input type="checkbox" class="status" id="{{ $listing['id'] }}" name="status">
                                @endif
                                    <span class="slider round"></span>
                                </label>
                            </td>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{URL::asset('./js/manage/listing.js')}}" ></script>