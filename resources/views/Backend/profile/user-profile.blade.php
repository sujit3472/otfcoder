@extends('layouts.adminapp')
@section('plugin_css')
    <!--alerts CSS -->
    <link href="{{ asset('js/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('page_heading')
    <h3 class="text-themecolor">{{trans('label.admin')}}</h3>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        @include('flash::message')
        <div class="card card-outline-info">
            <div class="card-body">
                
                {!! Form::model($user, [
                            'method' => 'PATCH',
                            'url' => ['/profile', $user->id],
                            'class' => 'form-horizontal',
                            'files' => true,
                            'autocomplete' => 'off'
                        ]) !!}
                        
                {{Form::hidden("id", (!empty($user->id)) ? $user->id : "", array("id" => "admin-id"))}}
                    <div class="form-body">
                        <h3 class="card-title">Edit Profile</h3>
                        <hr>
                        <!-- role and email -->
                        <div class="row p-t-20">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label class="control-label">{{trans('user.first_name')}}<sup class="text-danger">*</sup></label>
                                    {{Form::text("first_name", $value =(!empty($user->first_name)) ?$user->first_name : old("first_name") , array("class" => "form-control required ", "id"=>"first_name","placeholder" =>'First Name', 'maxlength' => '80'))}}
                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label class="control-label">{{trans('user.last_name')}}<sup class="text-danger">*</sup></label>
                                    {{Form::text("last_name", $value =(!empty($user->last_name)) ?$user->last_name : old("last_name") , array("class" => "form-control required ", "id"=>"last_name","placeholder" =>'Last Name', 'maxlength' => '80'))}}
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="control-label">{{trans('label.email')}}<sup class="text-danger">*</sup></label>
                                    {{Form::email("email", $value =(!empty($user->email)) ? $user->email : old("email") , array("class" => "form-control required", "id"=>"email","placeholder" =>'Email' , 'required'=>'required'))}}
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- end -->
                        <!-- passowrd and confrim password -->
                        @php($required = (!empty($user)) ? "" : "required")
                        @php($minlength = "6")
                        @php($maxlength = "20")
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">
                                        {{trans('label.password')}} 
                                        @if(!isset($user) || empty($user)) <sup class="text-danger">*</sup> @endif
                                    </label>
                                    {{Form::password("password", array("class" => "form-control ".$required, "id"=>"password","placeholder" =>"Password", "minlength"=>"$minlength", "maxlength"=>"$maxlength"))}}
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">
                                    {{trans('label.confirm_password')}}
                                    @if(!isset($user) || empty($user)) <sup class="text-danger">*</sup>@endif
                                    </label>
                                    {{Form::password("password_confirmation", array("class" => "form-control ".$required, "id"=>"password-confirm","placeholder" =>"Confirm Password",'equalTo'=>'#password', "minlength"=>"$minlength", "maxlength"=>"$maxlength"))}}
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- end -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label class="control-label">{{trans('label.mobile')}}<sup class="text-danger">*</sup></label>
                                    {{Form::text("phone", $value =(!empty($user->phone)) ?$user->phone : old("phone") , array("class" => "form-control required phone", "id"=>"phone","placeholder" =>'','minlength'=>'9','maxlength'=>'15'))}}
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class="form-group {{ $errors->has('avatar') ? 'has-error' : ''}}">
                                    {!! Form::label('avatar', trans('user.avatar'), ['class' => 'control-label']) !!}
                                    {!! Form::file('avatar', ('' == 'required') ? ['class' => 'form-control form-control-sm avatar', 'required' => 'required', 'accept' => 'image/*'] : ['class' => 'form-control form-control-sm avatar', 'accept' => 'image/*']) !!}
                                    
                                    {!! $errors->first('avatar', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="row user-role">
                            <div class="col-md-6"></div>
                            <div class='col-md-6 m-t-20'>
                                <div class="form-group" id="image-preview">
                                    
                                    <img src="{{ !empty($user) && !empty($user->avatar) ? $user->avatar : '' }}" alt="Featured Image" height="70" width="90" id="avtar_image">
                                    <span class="badge badge-danger remove-image" data-user-id = "{{ !empty($user) && !empty($user) ? $user->id : '' }}" id="remove-icon">X</span>
                                    <input name="profile_pic_id" type="hidden" id="profile_pic_id" value="{{ !empty($user) && !empty($user->avatar) ? $user->profile_pic_id : '' }}">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-info">
                        update
                        </button>&#160;
                        <a href="{{ url('/user-home') }}">{{ trans('label.cancel') }}</a>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/sweetalert/sweetalert.min.js')}}"></script>
<script>
    jQuery(document).ready(function ($) {
        @if(empty($user->profile_pic_id))
            $('#remove-icon').hide();
            $('#avtar_image').hide();
        @endif
        $("form[id='admin_profile']").validate();

        $('body').on('change', '.avatar', function(e) {
            console.log('false');
            e.preventDefault();
            var th     = $(this);
            var imagetype = $(this).data('imagetype');
            var ValidImageTypes = ["image/jpeg", "image/png", "image/jpg"];            
            var a = (th[0].files[0].size);
            var file = (th[0].files[0].type);
            if(a > 2000000 || ($.inArray(file, ValidImageTypes) < 0)) {
                swal("", 'File must be of type jpg,jpeg,png and size should be less than 2 MB.',  "warning" );
                th.value = '';
                $('input[type=file]').val("");
                return false;
            };
            var originalImage = $(this)[0].files[0];
            var formData = new FormData();
            formData.append('image',originalImage);
            formData.append('_token',"{{csrf_token()}}");
            $.ajax({
                url: "{{url('/uploadimages')}}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data){
                    $('#remove-icon').show();
                    $('#avtar_image').show();
                    $('#avtar_image').attr('src', data.image_path);
                    $('#profile_pic_id').val(data.id);
                }
            });            
        });

        $('body').on('keypress', '.phone', function(event) {
            if ((event.which != 190) && ( event.which < 46 || event.which > 57 || event.which == 47))
                event.preventDefault(); //stop character from entering input
        });

        $('body').on('click', '.remove-image', function (e) {
            var image_id   = $('#profile_pic_id').val();
            var user_id    = '{{ $user->id }}';
            $this = $(this);
            swal({   
                title: "Warning", 
                text: "Are You sure want to delete this image",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Yes",   
                closeOnConfirm: false,
                cancelButtonText : 'No'
            }, function(){
                $.ajax({
                    type : "POST",
                    url  : "{{url('delete-image')}}",
                    data : {'profile_pic_id' : image_id, 'user_id' : user_id,  "_token": "{{ csrf_token() }}"},
                    success: function(response) {
                        if (response == '1') {
                            $('input[type=file]').val("");
                            $('#profile_pic_id').val('');
                            $('#remove-icon').hide();
                            $('#avtar_image').hide();
                            swal("", "Image Deleted successfully!!", "success"); 
                        } else {
                            swal("", 'Something went wrong!!',  "success" );
                        }
                    }
                });
            });
        });
    });
</script>
@endsection
