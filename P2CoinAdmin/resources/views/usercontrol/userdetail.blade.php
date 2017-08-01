@extends('layouts.app')

@section('content')
<style>
 .btn-action  {
     width:100%;
     height:100%;
 }
</style>
<div class="panel panel-default">
{{ csrf_field() }}
  <div class="panel-body">
    <div class="col-md-6">
        <div class="portlet-body form">
            <form role="form">
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <input type="text" class="form-control" id="form_control_1" placeholder="Enter your name" value="{{ $user_info['name'] }}" readonly>
                        <label for="form_control_1">Username</label>
                        <span class="help-block">Some help goes here...</span>
                    </div>
                    <div class="form-group form-md-line-input">
                        <input type="text" class="form-control" id="form_control_1" placeholder="Enter your name" value="{{ $user_info['id'] }}" readonly>
                        <label for="form_control_1">User ID</label>
                        <span class="help-block">Some help goes here...</span>
                    </div>
                    <div class="form-group form-md-line-input">
                        <input type="text" class="form-control" id="form_control_1" placeholder="Enter your name" value="{{ $user_info['email'] }}" readonly>
                        <label for="form_control_1">User email</label>
                        <span class="help-block">Some help goes here...</span>
                    </div>
                    <div class="form-group form-md-line-input">
                        <input type="text" class="form-control" id="form_control_1" placeholder="Enter your name" value="{{ $user_info['user_status'] }}" readonly>
                        <label for="form_control_1">Account Status</label>
                        <span class="help-block">Some help goes here...</span>
                    </div>
                    <div class="form-group form-md-line-input">
                        <input type="text" class="form-control" id="form_control_1" placeholder="Enter your name" value="{{ $user_info['ip_address'] }}" readonly>
                        <label for="form_control_1">User IP Addess</label>
                        <span class="help-block">Some help goes here...</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="portlet-body form">
            <form role="form">
                <div class="form-body">
                    <div class="form-group form-md-line-input">
                        <button type='button' class="btn blue btn-action" id='btn_block_account'> Block/Unlock User Account </button>
                    </div>
                    <div class="form-group form-md-line-input">
                        <button type='button' class="btn blue btn-action" id='btn_block_ip'> Block/Unlock User IP Address </button>
                    </div>
                    <div class="form-group form-md-line-input">
                        <button type='button' class="btn blue btn-action" id='btn_send_message'> Send Message </button>
                    </div>
                    <div class="form-group form-md-line-input">
                        <button type='button' class="btn blue btn-action" id='btn_change_password'> Change User Password </button>
                    </div>
                    <div class="form-group form-md-line-input">
                        <button type='button' class="btn green btn-action" id='btn_back'>Back</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
<script src="{{ asset('./assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script>
$(document).ready(function(){
    $('#btn_block_account').click(doOnBlockAccount);
    $('#btn_block_ip').click(doOnBlockIP);
    $('#btn_send_message').click(doOnSendMessage);
    $('#btn_change_password').click(doOnChangeUserPassword);
    $('#btn_back').click(doOnBack);
});
function doOnBack() {
    window.location.href = '/usercontrol';
    window.reload();
}
function doOnBlockAccount() {
    
}
function doOnBlockIP() {
    
}
function doOnSendMessage() {
    
}
function doOnChangeUserPassword() {
    
}
</script>
@endsection