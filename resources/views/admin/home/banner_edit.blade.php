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
                <div class="card-title"> Edit Banner Section </div>
            </div>
            <div class="card-body">
            <form class="form-group" action="{{route('admin.banner_update',$banner->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="row mb-3 ">
                        <div class="form-group col-6">
                            <label id="folderLabel">Icon1</label>
                            <input type="file" name="icon1" class="form-control" value="{{ $banner->icon1}}">
                        </div> 
                        <div class="form-group col-6">
                            <label id="folderLabel">Icon1 Name</label>
                            <input type="text" name="icon1_name" class="form-control" value="{{ $banner->icon1_name}}">
                        </div> 
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-6">
                            <label id="folderLabel">Icon2</label>
                            <input type="file" name="icon2" class="form-control" value="{{ $banner->icon2}}">
                        </div> 
                        <div class="form-group col-6">
                            <label id="folderLabel">Icon2 Name</label>
                            <input type="text" name="icon2_name" class="form-control" value="{{ $banner->icon2_name}}">
                        </div> 
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-6">
                            <label id="folderLabel">Icon3</label>
                            <input type="file" name="icon3" class="form-control" value="{{ $banner->icon3}}">
                        </div> 
                        <div class="form-group col-6">
                            <label id="folderLabel">Icon3 Name</label>
                            <input type="text" name="icon3_name" class="form-control" value="{{ $banner->icon3_name}}">
                        </div> 
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-6">
                            <label id="folderLabel">Icon4</label>
                            <input type="file" name="icon4" class="form-control" value="{{ $banner->icon4}}">
                        </div> 
                        <div class="form-group col-6">
                            <label id="folderLabel">Icon4 Name</label>
                            <input type="text" name="icon4_name" class="form-control" value="{{ $banner->icon4_name}}">
                        </div> 
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-6">
                            <label id="folderLabel">Banner</label>
                            <input id="icon_name" type="file" name="banner" class="form-control">
                            <img id='p2' src="#" style="display:none;margin:10px;" class="rounded" >
                        </div>
                        <div class="form-group col-6">
                            <label id="folderLabel">Logo -Multiple Image select-</label>
                            <input id="icon_name" type="file" name="multi_logo[]" class="form-control" multiple>
                            <img id='p2' src="#" style="display:none;margin:10px;" class="rounded" >
                        </div>
                    </div>
                    <div class="form-group ">
                        <label id="folderLabel">Content</label>
                        <input type="text" name="content" class="form-control" value="{{ $banner->content}}">
                    </div> 
                <div class="form-group mt-3">
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
            let image = "{{ $banner->image }}";
            if (image) {
                let public_path = "{{asset('storage/app/public/'.$banner->image)}}";
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
    