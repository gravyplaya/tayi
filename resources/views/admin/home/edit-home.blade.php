@extends('admin.layout.app')
@section('content')


<div class="container">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
            <h6 class="card-title">Edit Home Page</h6>
            </div>
            <div class="card-body">

                <form action="{{ route('admin.updatehome',$how_to_box->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h3 class="text-center mb-3">How To Section</h3> 
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="box_heading" >Box Heading </label>
                            <div class="col-sm-12">
                                <input type="text" name="box_heading" class="form-control" id="box_heading" autocomplete="off" value="{{ $how_to_box->box_heading }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="box_content">Box Content </label>
                            <div class="col-sm-12">
                                <input type="text" name="box_content" class="form-control" id="box_content" autocomplete="off" value="{{ $how_to_box->box_content }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="icon" >Box Icon </label>
                            <div class="col-sm-12">
                                <input type="file" name="icon" class="form-control" id="icon" autocomplete="off" value="{{ $how_to_box->icon }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="box_image">Box Image </label>
                            <div class="col-sm-12">
                                <input type="file" name="box_image" class="form-control" id="box_image" autocomplete="off" value="{{ $how_to_box->box_image }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3" id="list">                            
                        <label for="box_image">Box List </label>
                        <?php  $boxlist = explode('",',$how_to_box->box_list);          ?>
                      
                        @foreach ($boxlist as $key => $row)   
                        <div id="row" class="d-flex">                         
                        <div class="col-sm-10 m-2" id="box_list{{$key}}">
                            <input  class="form-control" type="text" name="box_list[]" value="{{ $row}}">
                        </div>
                        <button class="btn btn-danger col-2 m-2" id="DeleteRow" type="button"><i class="bi bi-trash"></i> Delete</button>
                         </div>
                        @endforeach
                        <div class="row" align="right">
                            <div class="col-12">
                                <button id="rowAdder" type="button" class="btn btn-dark col-2" >ADD </button>
                            </div>
                        </div>
                    </div>
					<button type="submit" class="btn btn-primary me-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    var i = 1;
     $("#rowAdder").click(function () { 
       
       $("#list").append('<div id="row" class="d-flex"><div class="col-sm-10 mt-2"  ><input  class="form-control" type="text" name="box_list[]" id="box_list"></div><button class="btn btn-danger col-2 m-2" id="DeleteRow" type="button">' +
            '<i class="bi bi-trash"></i> Delete</button></div>');
    });

    $("body").on("click", "#DeleteRow", function () {
        $(this).parents("#row").remove();
    });
</script>
@endpush