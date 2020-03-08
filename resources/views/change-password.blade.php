@extends('layouts.adminapp')
@section('page_heading')
    <h3 class="text-themecolor">Change Password</h3>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('flash::message')
            <div class="card ">
                <div class="card-body">                    
                     {!! Form::open(['url' => '/changepassword/'.Auth::user()->id, 'class' => 'form-horizontal', 'files' => true,'id'=>'change-password', 'autocomplete' => 'off']) !!}
                        
                        @php
                            $required = (!empty($grower)) ? "" : "required";
                            $minlength = "6";
                            $maxlength = "20";
                        @endphp
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                                    {!! Form::label('password', trans('label.password'), ['class' => 'control-label']) !!}@if(!empty($required))<span class="text-danger">*</span>@endif
                                        {!! Form::password("password", array("class" => "form-control ".$required, "id"=>"password","placeholder" => trans('label.password'), "minlength"=>"$minlength", "maxlength"=>"$maxlength", "autocomplete" =>"user-password")) !!}
                                        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>                            
                        </div>
                        <div class='row'>                        
                            <div class='col-md-6'>
                                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
                                    {!! Form::label('password_confirmation', trans('label.confirm_password'), ['class' => 'control-label']) !!}@if(!empty($required))<span class="text-danger">*</span>@endif
                                       {!! Form::password("password_confirmation", array("class" => "form-control ".$required, "id"=>"password-confirm","placeholder" =>trans('label.confirm_password'),'equalTo'=>'#password', "minlength"=>"$minlength", "maxlength"=>"$maxlength")) !!}
                                        {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>                        
                        <div class="form-actions p-t-20">
                            {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Change Password', ['class' => 'btn btn-info save-btn']) !!}
                            <a href="{{url('/home')}}">Cancel</a>
                        </div>
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script>
    jQuery(document).ready(function ($) {
        $("#change-password").validate();
    });
</script>
@endsection
