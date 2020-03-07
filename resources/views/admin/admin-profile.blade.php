@extends('layouts.adminapp')
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
                                    {{Form::text("first_name", $value =(!empty($user->first_name)) ?$user->first_name : old("first_name") , array("class" => "form-control required ", "id"=>"first_name","placeholder" =>'Name'))}}
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
                                    {{Form::text("last_name", $value =(!empty($user->last_name)) ?$user->last_name : old("last_name") , array("class" => "form-control required ", "id"=>"last_name","placeholder" =>'Name'))}}
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
                                    {{Form::text("phone", $value =(!empty($user->phone)) ?$user->phone : old("phone") , array("class" => "form-control required ", "id"=>"phone","placeholder" =>'','minlength'=>'9','maxlength'=>'15'))}}
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-info">
                        update
                        </button>&#160;
                        <a href="{{ url('/home') }}">{{ trans('label.cancel') }}</a>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script>
    jQuery(document).ready(function ($) {
        $("form[id='admin_profile']").validate();

        /** allow to only enter number **/
        $('body').on('keypress', ' #mobile', function(event) {
            if ((event.which != 46 || event.which != 190 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57))
                event.preventDefault(); //stop character from entering input
        });
    });
</script>
@endsection
