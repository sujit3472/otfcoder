<div class="form-body m-t-20">
	@if(!isset($user) && empty($user))
    <h3 class="card-title">{{trans('user.create_user_form')}}</h3>
    @else
    <h3 class="card-title">{{trans('user.edit_user_form')}}
    </h3>
    @endif
    <hr>
	<div class="row">
		<div class='col-md-6'>
			<div class="form-group  {{ $errors->has('first_name') ? 'has-error' : ''}}">
			    {!! Form::label('first_name', trans('user.first_name'), ['class' => 'control-label']) !!}<span class="text-danger">*</span>
			        {!! Form::text('first_name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'maxlength' => '80', 'autocomplete' => 'none', 'id'=> 'first_name'] : ['class' => 'form-control', 'maxlength' => '80', 'autocomplete' => 'none', 'id'=> 'first_name']) !!}
			        {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		<div class='col-md-6'>
			<div class="form-group  {{ $errors->has('last_name') ? 'has-error' : ''}}">
			    {!! Form::label('last_name', trans('user.last_name'), ['class' => 'control-label']) !!}<span class="text-danger">*</span>
			        {!! Form::text('last_name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'maxlength' => '80', 'autocomplete' => 'none'] : ['class' => 'form-control', 'maxlength' => '80']) !!}
			        {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
			</div>
		</div>	
	</div>	
	<div class="row">
		<div class='col-md-6'>
			<div class="form-group  {{ $errors->has('email') ? 'has-error' : ''}}">
			    {!! Form::label('email', trans('user.email'), ['class' => 'control-label']) !!}<span class="text-danger">*</span>
			    	
			        {!! Form::text('email', $user->email ?? null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'false', 'id'=> 'email_id'] : ['class' => 'form-control', 'autocomplete' => 'false', 'id'=> 'email_id']) !!}
			        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class='col-md-6'>
			<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
			    {!! Form::label('password', trans('label.password'), ['class' => 'control-label']) !!}@if(!isset($user) || empty($user->id))<span class="text-danger">*</span>@endif
			        {!! Form::password('password', ['class' => 'form-control', 'maxlength' => '20', 'minlength' => '6']) !!}
			        {!! $errors->first('password', '<p class="text-danger">:message</p>') !!}
			        @if(isset($user) && !empty($user->id))<span>Keep blank if you don't want to update</span>@endif
			</div>
		</div>
		<div class="col-md-6">
		    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
		        {!! Form::label('password_confirmation', trans('label.password_confirmation'), ['class' => 'control-label']) !!}@if(!isset($user) || empty($user->id))<span class="text-danger">*</span>@endif
		            {!! Form::password('password_confirmation',['class' => 'form-control', 'maxlength' => '20', 'minlength' => '6', 'autocomplete' => 'none', 'id'=> 'password_confirmation']) !!}
		            {!! $errors->first('passwordleap_confirmation', '<p class="text-danger">:message</p>') !!}
		    </div>
		</div>
	</div>
	
	@php($disabled = isset($user) && !empty($user->id) ? false : false)
	
	<div class="row">
		<div class='col-md-6'>
			<div class="form-group  {{ $errors->has('role_id') ? 'has-error' : ''}}">
			    {!! Form::label('role', trans('user.role'), ['class' => 'control-label']) !!}<span class="text-danger">*</span>

			    {!! Form::select('role_id', [null=>'Select Role']+$role, ($user->role_id) ?? null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'disabled' => $disabled, 'id' => 'role-id' ] : ['class' => 'form-control', 'disabled' => $disabled, 'id' => 'role-id']) !!}
				@if(isset($user) && !empty($user->id))
			    	{!! Form::hidden('user_role_id', ($user->role_id) ?? null ) !!}
			    @endif
			    {!! $errors->first('role_id', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		<div class='col-md-6'>
			<div class="form-group  {{ $errors->has('phone') ? 'has-error' : ''}}">
			    {!! Form::label('phone', trans('user.phone'), ['class' => 'control-label']) !!}<span class="text-danger">*</span>
			    
			    {!! Form::text('phone', null, ('required' == 'required') ? ['class' => 'form-control phone', 'required' => 'required', 'maxlength' => '15', 'minlength' => '10', 'autocomplete' => 'none'] : ['class' => 'form-control phone',  'autocomplete' => 'none']) !!}
			        
			    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
	</div>	

	<div class="row user-role">
		<div class='col-md-6'>
			<div class="form-group {{ $errors->has('avatar') ? 'has-error' : ''}}">
			    {!! Form::label('avatar', trans('user.avatar'), ['class' => 'control-label']) !!}
			    {!! Form::file('avatar', ('' == 'required') ? ['class' => 'form-control form-control-sm avatar', 'required' => 'required', 'accept' => 'image/*'] : ['class' => 'form-control form-control-sm avatar', 'accept' => 'image/*']) !!}
			    
			    {!! $errors->first('avatar', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
	</div>
	<div class="row user-role">
		<div class='col-md-6 m-t-20'>
			<div class="form-group" id="image-preview">
				
				<img src="{{ !empty($user) && !empty($user->avatar) ? $user->avatar : '' }}" alt="Featured Image" height="70" width="90" id="avtar_image">
				<span class="badge badge-danger remove-image" data-user-id = "{{ !empty($user) && !empty($user) ? $user->id : '' }}" id="remove-icon">X</span>
				<input name="profile_pic_id" type="hidden" id="profile_pic_id" value="{{ !empty($user) && !empty($user->avatar) ? $user->profile_pic_id : '' }}">
			</div>
		</div>
	</div>
	<div class="row">
		@if(isset($user) && !empty($user->id))
		<div class='col-md-6'>
			<div class="form-group  {{ $errors->has('status') ? 'has-error' : ''}}">
			    {!! Form::label('status', trans('user.status'), ['class' => 'control-label']) !!}
			        @php($arr_status = Config::get('constants.arr_common_status'))
					{!! Form::select('status', $arr_status, null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
			        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
		@endif
	</div>
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-inverse']) !!} &nbsp;
            <a href="{{ url('/user') }}">{{ trans('label.cancel') }}</a>  
        </div>
    </div>
</div>