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
<?php

$how_to_sec =\App\Models\HowTo::where('name','howto')->select('id','main_content','main_heading')->first();


$storage= \DB::table('image_spaces')->first();
if($storage->aws == 1){
        $storage_space = "s3.aws";
    }
    else if($storage->wasabi == 1){
        $storage_space = "s3.wasabi";
    }else{
        $storage_space ="same_server";
    }

        if($storage_space != "same_server"){
        $url_aws =  rtrim(\Storage::disk($storage_space)->url('/'));
    }          
    else{
        $url_aws=url('/storage/app/public/').'/';
    } 
?>
   
    <!-- Row -->
    <div class="row">
       <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="card-title"> Edit Footer Block Section </div>
            </div>
            <div class="card-body">
            <form class="form-group" action="{{route('admin.footer_block_update',$footer_block->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="form-group mb-3">
                        <label id="folderLabel">Main Heading</label>
                        <input type="text" name="main_heading"  class="form-control" value="{{ $footer_block->main_heading}}">
                   </div>
                   <div class="form-group mb-3">
                    <label id="folderLabel">Heading</label>
                    <input type="text" name="heading" class="form-control" value="{{ $footer_block->heading}}">
                   </div> 
                   <div class="form-group mb-3">
                    <label id="folderLabel">Content</label>
                    <input type="text" name="content" class="form-control" value="{{ $footer_block->content}}">
                   </div> 
                   <div class="form-group mb-3">
                    <label id="folderLabel">List1</label>
                    <input type="text" name="list1" class="form-control" value="{{ $footer_block->list1}}">
                   </div> 
                   <div class="form-group mb-3">
                    <label id="folderLabel">List2</label>
                    <input type="text" name="list2" class="form-control" value="{{ $footer_block->list2}}">
                   </div> 
                   <div class="form-group">
                        <label id="folderLabel">Image</label>
                        <input id="icon_name" type="file" name="image" class="form-control">
                        <img id='p2' src="#" style="display:none;margin:10px;" class="rounded" >
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
            let image = "{{ $footer_block->image }}";
            if (image) {
                let public_path = "{{$url_aws.'footer_block/'.$footer_block->image}}";
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
    