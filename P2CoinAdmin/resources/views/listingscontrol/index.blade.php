@extends('layouts.app')

@section('content')
<style>
 .email-input  {
     width:400px;
     min-width:180px;
 }
</style>
<div class="panel panel-default">
{{ csrf_field() }}
  <div class="panel-body">
    <div class="portlet-body">
        <div class="row">
            <div class="col-md-12" >
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_0">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Listings Control</div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                    <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                                    <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="#" class="form-horizontal">
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="button" id = "view_all_listings" class="btn btn-circle green">View All Listings</button>
                                                <button type="button" id="view_reported_listings" class="btn btn-circle green">View Reported Listings</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-body">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="sample_1" role="grid" aria-describedby="sample_1_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 47px;">Seller</th>
                                                    <th class="sorting_desc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="descending" aria-label=" Username : activate to sort column ascending" style="width: 93px;">Currency</th>
                                                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label=" Email : activate to sort column ascending" style="width: 148px;">Terms Of Trade</th>
                                                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label=" Joined : activate to sort column ascending" style="width: 67px;">Payment_Details</th>
                                                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label=" Actions : activate to sort column ascending" style="width: 70px;">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody id="form_body-container">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
  </div>
</div>
<script src="{{ asset('./assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script>
$(document).ready(function(){
    $('#view_all_listings').click(doOnViewAllListings);
$('#view_all_listings').click(function(){
        var user_name = $('#user_name').val();
        var user_email = $('#user_email').val();
        var _token = $('meta[name=csrf-token]').attr('content');
        $.post('getuserbysearch', { user_name: user_name, user_email:user_email, _token:_token }, function(resp){
            $('#data_area').empty();
            data = JSON.parse(resp);
            tbodyStr = '';
            for(i=0;i<data.length;i++) {
                tmp = data[i];
                tbodyStr += '<tr class="gradeX odd" role="row"><td>'+tmp.id+'</td><td class="sorting_1">'+tmp.name+'</td><td><a href="mailto:userwow@gmail.com">'+tmp.email+'</a></td><td class="center">'+ tmp.created_at + '</td><td align=center><button class="view_user btn btn-success" type="button" user_id="'+tmp.id+'" onclick="doOnViewDetail(this)">View Detail</button></td></tr>';
            }
            $('#data_area').html(tbodyStr);
        });
    });
});
function doOnViewAllListings() {
    $.get('viewalllistings', function(resp_html){
        $('#form_body-container').html(resp_html);
    });
}
</script>
@endsection