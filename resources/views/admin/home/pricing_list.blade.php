
@extends('admin.layout.app')

@section('content')
<?php
$FreePlan=\App\Models\PricingSection::where('name','free')->first();
$PaidPlan=\App\Models\PricingSection::where('name','paid')->first();
$CustomPlan=\App\Models\PricingSection::where('name','custom')->first();
$main_pricing =\App\Models\HowTo::where('name','pricing')->select('id','main_content','main_heading')->first();
?>
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.css"  rel="stylesheet">
<style>
  .act-card:hover {
  box-shadow: 1px 1px 6px 1px grey;
  }
  .folder:hover{
    color:white !important;
  }

  .btn:hover {
color: #fff !important;
text-decoration: none;
}


.cardcheckbox {
    opacity: 1;
    width: 20px;
    height: 20px;

    }

    .act-card:hover,
    .cardcheckbox:checked {
        opacity: 1;
    }
	a { color: inherit !important; }
</style>
    <div class="container card">
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
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
          <div class="col-6 ">
            <h4 class=""><span style="border-bottom: 4px solid #6773ff;">Pricing section</span></h4>
          </div>         
            <div style="float:right !important ;margin: 15px 0px 0px 0px"><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editsection">
             Edit Pricing Secton
            </button> </div></div>
             
            <div class="row">
                <div class="col-4 card">
                    <div class="card-header"> <h5 class="text-center">Free Plan</h5></div>
                   
                    <form action="{{route('admin.pricing_update',$FreePlan->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="main_title" >Main Title</label>
                                <div class="col-sm-12">
                                    <input type="text" name="main_title" class="form-control" id="main_title" autocomplete="off" value="{{$FreePlan->main_title}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="title">Title</label>
                                <div class="col-sm-12">
                                    <input type="text" name="title" class="form-control" id="title" autocomplete="off" value="{{$FreePlan->title}}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="content" >Content</label>
                                <div class="col-sm-12">
                                    <input type="text" name="content" class="form-control" id="content" autocomplete="off" value="{{$FreePlan->content}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="btn_text">Button Text</label>
                                <div class="col-sm-12">
                                    <input type="text" name="btn_text" class="form-control" id="btn_text" autocomplete="off" value="{{$FreePlan->btn_text}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="main_content">Heading</label>
                            <div class="col-sm-12">
                                <input type="text" name="heading" class="form-control" id="heading" autocomplete="off" value="{{$FreePlan->heading}}">
                            </div>
                        </div>
                        <div class="row mb-3" id="free_list">                            
                            <label for="list_text">List </label>
                            <?php  $free_all_list = explode('",',$FreePlan->list_text);          ?>
                          
                            @foreach ($free_all_list as $key => $free_row_list)   
                            <div id="free_row" class="d-flex">                         
                            <div class="col-sm-10 m-2" id="free_list_text{{$key}}">
                                <input  class="form-control" type="text" name="list_text[]" value="{{ $free_row_list}}">
                            </div>
                            <button class="btn btn-danger m-2" id="free_DeleteRow" type="button"><i data-feather="trash"></i></button>
                             </div>
                            @endforeach
                            <div class="row" align="right">
                                <div class="col-12">
                                    <button id="free_rowAdder" type="button" class="btn btn-dark col-2" >ADD </button>
                                </div>
                            </div>
                        </div>

                        


                        <div class="card-footer">
                            <button type="submit" id="submit" class="btn btn-primary">Update Section</button>
                        </div>
                    </form>
                </div>
                <div class="col-4 card">
                    <div class="card-header"> <h5 class="text-center">Paid Plan</h5></div>
                   <form action="{{route('admin.pricing_update',$PaidPlan->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="main_title" >Main Title</label>
                                <div class="col-sm-12">
                                    <input type="text" name="main_title" class="form-control" id="main_title" autocomplete="off" value="{{$PaidPlan->main_title}} ">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="title">Title</label>
                                <div class="col-sm-12">
                                    <input type="text" name="title" class="form-control" id="title" autocomplete="off" value="{{$PaidPlan->title}} ">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="content" >Content</label>
                                <div class="col-sm-12">
                                    <input type="text" name="content" class="form-control" id="content" autocomplete="off" value="{{$PaidPlan->content}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="btn_text">Button Text</label>
                                <div class="col-sm-12">
                                    <input type="text" name="btn_text" class="form-control" id="btn_text" autocomplete="off" value="{{$PaidPlan->btn_text}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="main_content">Heading</label>
                            <div class="col-sm-12">
                                <input type="text" name="heading" class="form-control" id="heading" autocomplete="off" value="{{$PaidPlan->heading}} ">
                            </div>
                        </div>
                        <div class="row mb-3" id="paid_list">                            
                            <label for="list_text">List </label>
                            <?php  $paid_all_list = explode('",',$PaidPlan->list_text);          ?>
                          
                            @foreach ($paid_all_list as $key => $paid_row_list)   
                            <div id="paid_row" class="d-flex">                         
                            <div class="col-sm-10 m-2" id="paid_list_text{{$key}}">
                                <input  class="form-control" type="text" name="list_text[]" value="{{ $paid_row_list}}">
                            </div>
                            <button class="btn btn-danger m-2" id="paid_DeleteRow" type="button"><i data-feather="trash"></i></button>
                             </div>
                            @endforeach
                            <div class="row" align="right">
                                <div class="col-12">
                                    <button id="paid_rowAdder" type="button" class="btn btn-dark col-2" >ADD </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" id="submit" class="btn btn-primary">Update Section</button>
                        </div>
                    </form>
                 
                </div>
                <div class="col-4 card">
                    <div class="card-header">
                        <h5 class="text-center">Custom Plan</h5>
                    </div>
                      <form action="{{route('admin.pricing_update',$CustomPlan->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="main_title" >Main Title</label>
                                <div class="col-sm-12">
                                    <input type="text" name="main_title" class="form-control" id="main_title" autocomplete="off" value="{{$CustomPlan->main_title}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="title">Title</label>
                                <div class="col-sm-12">
                                    <input type="text" name="title" class="form-control" id="title" autocomplete="off" value=" {{$CustomPlan->title}}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="content" >Content</label>
                                <div class="col-sm-12">
                                    <input type="text" name="content" class="form-control" id="content" autocomplete="off" value="{{$CustomPlan->content}} ">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="btn_text">Button Text</label>
                                <div class="col-sm-12">
                                    <input type="text" name="btn_text" class="form-control" id="btn_text" autocomplete="off" value="{{$CustomPlan->btn_text}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="main_content">Heading</label>
                            <div class="col-sm-12">
                                <input type="text" name="heading" class="form-control" id="heading" autocomplete="off" value="{{$CustomPlan->heading}} ">
                            </div>
                        </div>

                        <div class="row mb-3" id="custom_list">                            
                            <label for="list_text">List </label>
                            <?php  $all_list = explode('",',$CustomPlan->list_text);          ?>
                          
                            @foreach ($all_list as $key => $row_list)   
                            <div id="custom_row" class="d-flex">                         
                            <div class="col-sm-10 m-2" id="custom_list_text{{$key}}">
                                <input  class="form-control" type="text" name="list_text[]" value="{{ $row_list}}">
                            </div>
                            <button class="btn btn-danger m-2" id="custom_DeleteRow" type="button"><em data-feather="trash"></em></button>
                             </div>
                            @endforeach
                            <div class="row" align="right">
                                <div class="col-12">
                                    <button id="custom_rowAdder" type="button" class="btn btn-dark col-2" >ADD </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="submit" class="btn btn-primary">Update Section</button>
                        </div>
                    </form>  
                  
                </div>
            </div>
            
            
      
    </div>

            
  <!--How to Secton Modal -->
  <div class="modal fade" id="editsection" tabindex="-1" aria-labelledby="folderLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
           <h5 class="modal-title" id="folderLabel">How to section</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
        <form action="{{route('admin.how_to_section_update',$main_pricing->id)}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="modal-body">
            <div class="form-group">
              <div class="row mb-3">
                  <div class="col-6">
                      <label for="main_heading" >Main Heading</label>
                      <div class="col-sm-12">
                          <input type="text" name="main_heading" class="form-control" id="main_heading" autocomplete="off" value="{{$main_pricing->main_heading}} ">
                      </div>
                  </div>
                  <div class="col-6">
                      <label for="main_content">Main Content</label>
                      <div class="col-sm-12">
                          <input type="text" name="main_content" class="form-control" id="main_content" autocomplete="off" value="{{$main_pricing->main_content}} ">
                      </div>
                  </div>
              </div>
             
             </div> 
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('lang.close')}}</button>
          <button type="submit" id="submit" class="btn btn-primary">Update Section</button>
        </div>
        </form>
      </div>
    </div>
  </div>  
@endsection
@push('scripts')

<script>
   
    //Free
     $("#free_rowAdder").click(function () { 
       
       $("#free_list").append('<div id="free_row"><div class="col-sm-10 mt-2"  ><input  class="form-control" type="text" name="list_text[]" id="free_list_text"></div><button class="btn btn-danger" id="free_DeleteRow" type="button">' +
            '<i data-feather="trash"></i></button></div>');
    });

    $("body").on("click", "#free_DeleteRow", function () {
        $(this).parents("#free_row").remove();
    });
    // Paid
     $("#paid_rowAdder").click(function () { 
       
       $("#paid_list").append('<div id="paid_row"><div class="col-sm-10 mt-2"  ><input  class="form-control" type="text" name="list_text[]" id="paid_list_text"></div><button class="btn btn-danger" id="paid_DeleteRow" type="button">' +
            '<i data-feather="trash"></i></button></div>');
    });

    $("body").on("click", "#paid_DeleteRow", function () {
        $(this).parents("#paid_row").remove();
    });
    // Custom
     $("#custom_rowAdder").click(function () {       
       $("#custom_list").append('<div id="custom_row"><div class="col-sm-10 mt-2"  ><input  class="form-control" type="text" name="list_text[]" id="custom_list_text"></div><button class="btn btn-danger" id="custom_DeleteRow" type="button">' +
            '<i data-feather="trash"></i></button></div>');
    });

    $("body").on("click", "#custom_DeleteRow", function () {
        $(this).parents("#custom_row").remove();
    });
</script>
@endpush
