@extends('layouts.app')
@section('content')

    <div class="container">
        <h3>Your profile</h3>
        <div class="container">
            <div>{{ $user->name }}</div>
            <div>{{ $user->email }}</div>
            <div>{{ $wallet_address }}</div>
        </div>    
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{URL::asset('./js/profile/index.js')}}" ></script>