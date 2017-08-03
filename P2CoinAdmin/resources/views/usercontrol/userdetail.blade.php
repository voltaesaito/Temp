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
                        <input type="checkbox" class="make-switch" data-on-text="&nbsp;Block&nbsp;" data-on-color="danger" data-off-color="success" data-off-text="&nbsp;Unblock&nbsp;" id="btn_block_account"  uid="{{ $user_info['id'] }}" onchange="doOnBlockAccount({{ $user_info['id'] }})" {{ $user_info['block_account_status'] }}><span>  User Account </span>
                    </div>
                    <div class="form-group form-md-line-input">
                        <input type="checkbox" class="make-switch" data-on-text="&nbsp;Block&nbsp;" data-on-color="danger" data-off-color="success" data-off-text="&nbsp;Unblock&nbsp;" id="btn_block_ip" uid="{{ $user_info['id'] }}" onchange="doOnBlockIP({{ $user_info['id'] }})" {{ $user_info['block_ip_status'] }}><span>  User  IP Address </span>
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
<div id="confirm_dialog" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"P2coin.net</h4>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to delete this listing? </p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancel</button>
                <button type="button" data-dismiss="modal" class="btn green" onclick="doOnForceDelete()">Delete</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('./assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script>
$(document).ready(function(){
    $('#btn_block_account').click(doOnBlockAccount);
    $('#btn_block_ip').change(doOnBlockIP);
    $('#btn_send_message').click(doOnSendMessage);
    $('#btn_change_password').click(doOnChangeUserPassword);
    $('#btn_back').click(doOnBack);
});
function doOnBack() {
    window.location.href = '/usercontrol';
    window.reload();
}
function doOnBlockAccount(user_id) {
    var ststus = 0;
    ($('#btn_block_account').is(':checked')) ? status = 1 : status = 0;
    _token = $('meta[name=csrf-token]').attr('content');
    $.post('/blockuser', { user_id: user_id, _token:_token, status: status, type: 'account' }, function(resp){

    });
}
function doOnBlockIP(user_id) {
    var ststus = 0;
    ($('#btn_block_account').is(':checked')) ? status = 1 : status = 0;
    _token = $('meta[name=csrf-token]').attr('content');
    $.post('/blockuser', { user_id: user_id, _token:_token, status: status, type: 'ip' }, function(resp){

    });
}
function doOnSendMessage() {
    
}
function doOnChangeUserPassword() {
    
}
</script>
@endsection