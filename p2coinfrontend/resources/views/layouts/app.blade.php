<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'P2Coin') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app_ext.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
     <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <style>
        body{
            padding-top:70px;background-color:white;
            background-image:url('./public/assets/images/bk-img.jpg');
            background:rgba(255,255,255,0.4);
        }
        .form-control {
            border: 1px solid #42a212;
            border-radius:0px!important;
        }
        .form-control:focus {
            border-color: #427212;
            outline: 0;
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(152,203,232,.6);
        }

        label, h1,h2,h3,h4,h5,h6, .menu-caption {
            color: #028840!important;
            background-color: transparent;
        }
        .btn-green{
                color: #028840;
                font-weight: bold;
                background-color: rgba(37, 157, 109, 0.01);
                border: 2px solid #028840;
        }
        .menu-a {
            color: #777777!important;
            /*font-weight: bold;*/
            font-size: 15px;
        }
        .menu-a:hover {
            color:green!important;
        }
        .h-title{
            font-weight:bold;
        }
        .security-level-strong{
            color: #02a240!important;
        }
        .security-level-weak{
            color:red!important;
        }
        .navbar-fixed-bottom .navbar-collapse, .navbar-fixed-top .navbar-collapse {
            max-height: 640px;
        }
        .nav-span-rate{
            padding-top: 15px;
            padding-bottom: 15px;
            display: block;
            cursor: pointer;
        }
        .menu-currency{
            cursor:pointer;
            background-color:white;
            width:100%;
        }
        .menu-currency:hover{
            background-color:#f5f5f5;
        }
        .label-caption-title{
            text-align: left;
            font-style: italic;
            color: grey!important;
            font-weight: 400;
            float:left;
        }
        .currrency-green{
            border: 1px solid #02a240!important;
            border-radius:0px;
        }
        .title-border-bottom {
            border-bottom: lightgreen 1px solid;
        }
        .title-content-body {
            min-height: 240px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-fixed-top navbar-default">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand a-logo-brand" href="{{ url('/') }}">
{{--                        {{ config('app.name', 'P2Coin') }}--}}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a class="menu-a" href="{{ route('trade') }}">Trade</a></li>
                        @if (!Auth::guest())
                            <li><a class="menu-a" href="{{ route('managelistings') }}">Mange Listings</a></li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                            @if (!Auth::guest())
                        <li>
                            <li class="dropdown user-panel-dd">
                                <a class="dropdown-toggle menu-a" data-toggle="dropdown" href="#user_dropdown" aria-expanded="false">
                                    Currency<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-panel-dd"><div class="menu-currency"><i class="fa fa-btc fa-fw"></i>&nbsp;BTC</div></li>
                                    <li class="user-panel-dd"><div class="menu-currency"><i class="fa fa-sort fa-fw"></i>&nbsp;ETH</div></li>
                                </ul>
                            </li> 
                        </li>
                        <li style="margin-right: 20px;">
                            <span class="nav-span-rate" id="currency_rate"><i class="fa fa-btc fa-fw"></i>&nbsp;BTC:2.34567</span>
                        </li>
                            @endif
                        @if (Auth::guest())
                            <li><a class="menu-a" href="{{ route('login') }}">Log In</a></li>
                            <li><a class="menu-a" href="{{ route('register') }}">SignUp</a></li>
                        @else                            
                                                
                            <li class="dropdown user-panel-dd">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#user_dropdown" aria-expanded="false">
                                    <i class="fa fa-navicon fa-fw"></i><b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-panel-dd"><a href="wallet"><i class="fa fa-btc fa-fw"></i>&nbsp;Wallet</a></li>
                                    <li><a href="{{ route('userprofile') }}"><i class="fa fa-edit fa-fw"></i>&nbsp;Profile</a></li>
                                    <li class="divider"></li>  
                                    <li class="user-panel-dd"><a href="/accounts/wallet/"><i class="fa fa-truck fa-fw"></i>&nbsp;Open Trades</a></li>                                  
                                    <li class="divider"></li>
                                    <li class="user-panel-dd"><a href="/accounts/wallet/"><i class="fa fa-bar-chart fa-fw"></i>&nbsp;Charts</a></li>                                  
                                    <li class="divider"></li>
                                    <li class="user-panel-dd"><a href="/settings"><i class="fa fa-sliders fa-fw"></i>&nbsp;Settings</a></li>                                  
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out fa-fw"></i>&nbsp;Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li> 
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

   
</body>
</html>
