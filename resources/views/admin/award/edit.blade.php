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
                <div class="card-title"> Edit Badges </div>
            </div>
            <div class="card-body">
            <form class="form-group" action="{{route('admin.award.update',$award->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label id="folderLabel">{{ __('lang.name')}}</label>
                    <input type="text" name="name"  class="form-control" value="{{ $award->name}}">
                   </div>
                   <div class="form-group">
                    <label id="folderLabel">{{ __('lang.icon')}}</label>
                    <input id="icon_name" type="file" name="icon" class="form-control">
                    <img id='p2' src="#" style="display:none;margin:10px;" class="rounded" >
                   </div>
                  
                   <div class="form-group mb-3">
                    <label id="folderLabel">{{ __('lang.tokens')}}</label>
                    <input type="text" name="tokens" class="form-control" value="{{ $award->tokens}}">
                   </div>  
                <div class="form-group mb-3">
                    <button type="submit" id="submit" class="btn btn-primary right">{{ __('lang.update')}}</button>
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
            let image = "{{ $award->icon }}";
            if (image) {
                let public_path = "{{asset('storage/app/public/'.$award->icon)}}";
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
    