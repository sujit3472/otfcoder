@extends('layouts.adminapp')
@section('plugin_css')
    <!--alerts CSS -->
    <link href="{{ asset('js/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('js/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('flash::message')
            <div class="card">
                <div class="card-body">
                @if(isset($user) && count($user) == 0)
                   <h3 class="card-title">{{ trans('user.no_user_available')}}</h3>
                @else
                    <h3 class="card-title">User List
                        <a href="{{ url('/user/create') }}" class="btn btn-inverse btn-sm pull-right" title="Add New User" >
                            <i class="fa fa-plus" aria-hidden="true"></i>{{ trans('label.add_new') }}
                        </a>
                    </h3>   
                    <hr/>
                    <div class="table-responsive">
                        <table class="table table-borderless" id="userTable">
                            <thead>
                                <tr>                                    
                                    <th>{{ trans('label.name') }}</th>
                                    <th>{{ trans('label.email') }}</th>
                                    <th>{{ trans('label.role') }}</th>
                                    <th>{{ trans('label.status') }}</th>
                                    <th>{{ trans('label.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($user as $item)
                                <tr>
                                    <td>{{ $item->full_name }}</td>
                                    
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role->name }}</td>
                                    <td>
                                        <span class="label label-sm {{$item->statusClass}} user-status" data-user_id ="{{$item['id']}}" data-status="{{$item->status_name}}" style="cursor: pointer;">{{$item->status_name}}</span>
                                    </td>
                                    <td>
                                        <a href="{{ url('/user/' . $item->id . '/edit') }}" title="Edit Page"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a id="delete_faq_{{$item->id}}" data-id="{{$item->id}}" href="#" title="{{trans('label.deleteaction')}}" class="delete-btn">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')    
<script src="{{ asset('js/sweetalert/sweetalert.min.js')}}"></script>    
<!-- Data Tables -->
<script src="{{ asset('js/dataTables/datatables.min.js') }}"></script>
<script>
    jQuery(document).ready(function($) {
        $('#userTable').DataTable({
            "pageLength": 10,
            responsive: true,
            "bSort": true,
            "aoColumns": [
                null,
                null,
                null,
                { "bSortable": false },
                { "bSortable": false },
            ],
            "aaSorting": [],
        });
        /** change status (Active/Inactive) **/
        $('body').on('click','.user-status',function() {
           var user_id = $(this).data('user_id');
           var current_status = ($(this).data('status'));
           var disp_status = (current_status == 'Active') ? 'Inactive' : 'Active';
           
           $this = $(this);
           swal({   
                title: "Warning", 
                text: "Are you sure you want to change the user status to " + disp_status + " ?",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Yes",   
                closeOnConfirm: false,
                cancelButtonText : 'No'
           }, function(){
               $this.removeClass('label-inverse label-danger');
               $.ajax({
                   type : "POST",
                   url  : "{{url('changestatus')}}",
                   data : {int_id : user_id, change_action : disp_status, modelName : 'App\\User', "_token": "{{ csrf_token() }}"},
                   success: function(response) {
                        if (response == '1') {
                           swal("", "Activated Successfully!!", "success"); 
                           $this.text('Active');
                           $this.addClass('label-inverse');
                           $this.data('status', 'Active');
                        } else {
                           swal("", 'Inactivated Successfully!!',  "success" );
                           $this.text('Inactive');
                           $this.addClass('label-danger');
                           $this.data('status', 'Inactivated');
                        }
                   }
               });
           });
        });  

        /** to show confirm box when click on delete button **/
        $('body').on('click','.delete-btn',function() {
            $this = $(this);
            swal({ 
                title: "Warning",
                text : "Are you sure you want to delete the user?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false,
                cancelButtonText : 'No'
            }, function(){
                var id = $this.data('id');
                delete_url = "{!! url('user/"+id+"/delete') !!}";
                window.location.replace(delete_url);
            });

        }); 
    }); 
</script>
@endsection