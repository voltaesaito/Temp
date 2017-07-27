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
.tbl-title { line-height: 200%; color: white; }
.spacer { margin-top: 20px; }
</style>
<!-- <script> var json_listing=<?php //echo json_encode($listing); ?> </script> -->

<?php $btc_disabled=$eth_disabled=''; ?>

<meta name="csrf-token" content="{{ Session::token() }}"> 
<div class="container">
    <div class="row">
<!--        --><?php //if (session()->get('btc_amount') == 0 && session()->get('eth_balance')==0)
////            echo "<div class=\"alert alert-danger\">
////                      <strong>Warning!</strong> Your wallets are blanked yet. If you deposit coins to your wallets, Please click <a href=\"{{ route('wallet') }}\" class=\"alert-link\">here</a>.
////                  </div>";
//        ?>
        <div class="col-md-12 text-center">
            <h3 class="h-title">Manage Listings</h3>
        <div>
        <div class="col-md-12 title-content-body">
            <div class="table-responsive">   
            <table class="table table-bordered">
            <thead>
                <tr style="background: #00b8e6;">
                    <th colspan = '5'>
                        <div class="col-sm-6 text-left tbl-title">Bitcoin</div>
                        <div class="col-sm-6 text-right"><a href="/addlistings/{{ '-1' }}" class="btn btn-white {{ $btc_disabled }}">+Add Listing</a></div>
                    </th>
                </tr>
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
        <div class="col-md-12 text-center">
            <button class="btn btn-success btn-green see-more" prop="btc">See More</button>
        </div>
        <div class="col-md-12 title-content-body spacer">
            <div class="table-responsive">          
            <table class="table table-bordered">
            <thead>
                <tr style="background: #028840;">
                    <th colspan = '5'>
                        <div class="col-sm-6 text-left tbl-title">Ethereum</div>
                        <div class="col-sm-6 text-right"><a href="/addlistings/{{ '-2' }}" class="btn btn-white {{ $eth_disabled }}">+Add Listing</a></div>
                    </th>
                </tr>
                <tr>
                    <th class="text-center" width="10%">#</th>
                    <th class="text-center" width="10%">Edit</th>
                    <th class="text-center" width="50%;">Discription</th>
                    <th class="text-center" width="15%">Price</th>
                    <th class="text-center" width="15%">Status</th>
                </tr>
            </thead>
            <tbody id="eth_list">
            </tbody>
            </table>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <button class="btn btn-success btn-green see-more" prop="eth">See More</button>
        </div>
    </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{URL::asset('./js/manage/index.js')}}" ></script>