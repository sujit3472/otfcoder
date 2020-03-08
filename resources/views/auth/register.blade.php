@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus maxlength="80">

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus maxlength="80">

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required minlength="6" maxlength="20">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required minlength="6" maxlength="20">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control phone" name="phone" value="{{ old('phone') }}" required autofocus minlength="10" maxlength="15">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('avatar') ? 'has-error' : ''}}">
                            <label for="name" class="col-md-4 control-label">Profile Picture</label>

                            <div class="col-md-6">
                                <input id="avatar" type="file" class="form-control avatar" name="avatar" autofocus accept="image/*">

                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4"></div>
                            <div class="col-md-6">
                                <img src="" alt="Featured Image" height="70" width="90" id="avtar_image">
                                <span class="badge badge-danger remove-image" data-user-id = "" id="remove-icon">X</span>
                                <input name="profile_pic_id" type="hidden" id="profile_pic_id" value="{{ old('profile_pic_id') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script>
    jQuery(document).ready(function($) {
        $('#remove-icon').hide();
        $('#avtar_image').hide();
        $('body').on('change', '.avatar', function(e) {
            console.log('false');
            e.preventDefault();
            var th        = $(this);
            var imagetype = $(this).data('imagetype');
            var ValidImageTypes = ["image/jpeg", "image/png", "image/jpg"];            
            var a = (th[0].files[0].size);
            var file = (th[0].files[0].type);
            if(a > 2000000 || ($.inArray(file, ValidImageTypes) < 0)) {
                alert('File must be of type jpg,jpeg,png and size should be less than 2 MB.');
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
            $this = $(this);
            confirm("Are You sure want to delete this image");
            $.ajax({
                type : "POST",
                url  : "{{url('delete-image')}}",
                data : {'profile_pic_id' : image_id, "_token": "{{ csrf_token() }}"},
                success: function(response) {
                    if (response == '1') {
                        $('input[type=file]').val("");
                        $('#remove-icon').hide();
                        $('#avtar_image').hide();
                        alert("Image Deleted successfully!!", "success"); 
                    } else {
                        alert('Something went wrong!!',  "success" );
                    }
                }
            });
        });        
    });
</script>
@endsection    


