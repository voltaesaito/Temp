@extends('layouts.app')
@section('content')

    <div class="container">
        <h3>Settings</h3>
        <div class="form-group">
            <div class="col-md-12">
                <label for="group_pin_code">2FA One Time Pin:</label>
                <div class="input-group">
                    <input class="numberinput form-control" id="pin_code" name="pin_code" required>
                    <a id="btn_authorize" class="btn input-group-addon">Authorize</a>
                </div>
                    <div id="invalid_title" class="hidden" style="color: red; font-weight: 800;">INVALID</div>
            </div>
            {{--<input type="text" class="form-control" id="pin_code">--}}
        </div>
    </div>
<script src="{{URL::asset('./js/settings/update2fa.js')}}" ></script>
@endsection