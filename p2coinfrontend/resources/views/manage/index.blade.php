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
                <table class="table">
                    <thead>
                        <tr>
                            <th class="menu-caption">#</th>
                            <th class="menu-caption">Edit</th>
                            <th class="menu-caption">Description</th>
                            <th class="menu-caption">Price</th>
                            <th class="menu-caption">Equation</th>
                            <th class="menu-caption">Status</th>
                        </tr>
                    </thead>
                    <tbody>
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
                        <tr>
                            <th class="menu-caption">#</th>
                            <th class="menu-caption">Edit</th>
                            <th class="menu-caption">Description</th>
                            <th class="menu-caption">Price</th>
                            <th class="menu-caption">Equation</th>
                            <th class="menu-caption">Status</th>
                        </tr>
                    </thead>
                    <tbody>
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