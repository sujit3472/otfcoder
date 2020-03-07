@extends('layouts.adminapp')
@section('plugin_css')
    <!--alerts CSS -->
    <link href="{{ asset('js/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <style>
        .error { color: red; }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('flash::message')
            <div class="card ">
                <div class="card-body">
                    {!! Form::model($user, [
                            'method' => 'PATCH',
                            'url' => ['/user', $user->id],
                            'class' => 'form-horizontal',
                            'files' => true,
                        ]) !!}

                        @include ('Backend.user.form', ['submitButtonText' => 'Update'])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')    
<!-- Sweet-Alert  -->
<script src="{{ asset('js/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script>
    jQuery(document).ready(function($) {
        @if(empty($user->profile_pic_id))
            $('#remove-icon').hide();
            $('#avtar_image').hide();
        @endif 
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