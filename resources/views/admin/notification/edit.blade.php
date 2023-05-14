@extends('admin.layout.app')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
        @if(is_array(session()->get('success')))
            <ul>
                @foreach (session()->get('success') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @else
            {{ session()->get('success') }}
        @endif
        </div>
    @endif
    @if (count($errors) > 0)
        @if($errors->any())
        <div class="alert alert-danger" role="alert">
            {{$errors->first()}}

        </div>
        @endif
    @endif
   
    <!-- Row -->
    <div class="row">
       <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="card-title"> {{ __('lang.editnotification')}} </div>
            </div>
            <div class="card-body">
            <form class="form-group" action="{{route('admin.notification_update',$noti->id)}}" method="post">
                @csrf                    
                <div class="form-group mb-3">
                    <label id="folderLabel">{{ __('lang.typenotification')}}</label>
                    <select  class="form-control" name="noti_type" id="">
                       <option>{{ __('lang.select')}}</option>
                       <option {{ $noti->noti_type  == '0' ? 'selected' : '' }} value="0"> {{ __('lang.warning')}}</option>
                       <option {{ $noti->noti_type  == '1' ? 'selected' : '' }} value="1"> {{ __('lang.info')}}</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label id="folderLabel">{{ __('lang.title')}}</label>
                    <input type="text" name="title" class="form-control" value="{{$noti->title}}">
                </div>                            
                <div class="form-group mb-3">
                    <label id="folderLabel">{{ __('lang.image')}}</label>
                    <input type="file" id="profile_picture" name="noti_image" class="form-control">
                    <img id='p2' src="#" style="display:none;margin:10px;" class="rounded" >
                </div>
                <div class="form-group">
                    <label id="folderLabel">{{ __('lang.usertype')}}</label>
                    <select  class="form-control" name="user_type" id="" >
                        <option>{{ __('lang.select')}}</option>
                        <option {{ $noti->user_type  == '0' ? 'selected' : '' }} value="0">{{ __('lang.free')}}</option>
                        <option {{ $noti->user_type  == '1' ? 'selected' : '' }} value="1">{{ __('lang.paid')}}</option>
                     </select>
                </div>
                <div class="form-group">
                 <label id="folderLabel">{{ __('lang.discription')}}</label>
                 <input type="text" name="discrtiption" class="form-control" value="{{$noti->discrtiption}}">
                </div> 
                <div class="form-group">
                    <label id="folderLabel">{{ __('lang.notificationurl')}}</label>
                    <input type="text" name="noti_url" class="form-control" value="{{$noti->noti_url}}">
                   </div> 
                <br>
                <div class="form-group">
                    <button type="submit" id="submit" class="btn btn-primary right">{{ __('lang.updatenotification')}}</button>
                </div>
            </form> 
        </div>
       </div>
    </div>   
<!-- /Row -->
</div>
@endsection
@push('scripts')
    
<script>
      $(document).ready(function() {
            let image = "{{ $noti->icon }}";
            if (image) {
                let public_path = "{{asset('storage/app/public/'.$noti->icon)}}";
                $(".close").removeClass("closeimg");
                $("#p2").removeClass("imageclose");
                $('#p2').show()
                    .attr('src', public_path)
                    .height(150);
                $('#icon').addClass('uploadimg');
            }
            $(".removeImage").click(function() {
                $('#p2').removeAttr('src');
                $("#p2").addClass("imageclose");
                $(this).addClass("closeimg");
                $('#icon').removeClass('uploadimg');
                $('#icon_name').val('');
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                $(".close").removeClass("closeimg");
                $("#p2").removeClass("imageclose");
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#p2').show()
                        .attr('src', e.target.result)
                        .height(150);
                };
                $('#icon').addClass('uploadimg');
                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
@endpush
    