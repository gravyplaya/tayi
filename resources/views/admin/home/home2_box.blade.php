
@extends('admin.layout.app')

@section('content')
<?php
$home2 =\App\Models\HowTo::where('name','home2')->select('id','main_content','main_heading','name')->first();
// dd($home2);
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
            <h4 class=""><span style="border-bottom: 4px solid #6773ff;">Home-2 section</span></h4>
          </div>
            <div class="col-6">
                <div style="float:right !important ;margin: 15px 0px 0px 0px">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#boxes">Add Boxes</button> 
                </div>
            </div>
            <div style="float:right !important ;margin: 15px 0px 0px 0px">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editsection"> Edit Home-2 Section </button> 
            </div>
        </div>
                    
           
      <div class="row">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard tables_design_space_fix">
                <div class="table-responsive">
                    <table class="data-table table_fix">
                        <thead>
                            <tr>
                                <th>{{__('Sr.No.') }}</th>
                                <th>Box Heading</th>
                                <th>Box Content</th>
                                <th>Box Icon</th>
                                <th>{{__('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>


 <!-- Modal -->
 <div class="modal fade" id="boxes" tabindex="-1" aria-labelledby="folderLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
           <h5 class="modal-title" id="folderLabel">Use Cases section</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
        <form action="{{route('admin.home2_box_create')}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="modal-body">
            <div class="form-group">                    
              <div class="row mb-3">
                  <div class="col-6">
                      <label for="box_heading" >Box Heading </label>
                      <div class="col-sm-12">
                          <input type="text" name="box_heading" class="form-control" id="box_heading" autocomplete="off" value="">
                      </div>
                  </div>
                  <div class="col-6">
                      <label for="box_content">Box Content </label>
                      <div class="col-sm-12">
                          <input type="text" name="box_content" class="form-control" id="box_content" autocomplete="off" value="">
                      </div>
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-6">
                      <label for="icon" >Box Icon </label>
                      <div class="col-sm-12">
                          <input type="file" name="icon" class="form-control" id="icon" autocomplete="off" value="">
                      </div>
                  </div>                            
              </div>                        
             </div> 
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('lang.close')}}</button>
          <button type="submit" id="submit" class="btn btn-primary">Crete Boxes</button>
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
        <form action="{{route('admin.how_to_section_update',$home2->id)}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="modal-body">
            <div class="form-group">
              <div class="row mb-3">
                  <div class="col-6">
                      <label for="main_heading" >Main Heading</label>
                      <div class="col-sm-12">
                          <input type="text" name="main_heading" class="form-control" id="main_heading" autocomplete="off" value="{{$home2->main_heading}} ">
                      </div>
                  </div>
                  <div class="col-6">
                      <label for="main_content">Main Content</label>
                      <div class="col-sm-12">
                          <input type="text" name="main_content" class="form-control" id="main_content" autocomplete="off" value="{{$home2->main_content}} ">
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
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(function () {
            var table = $('.data-table').DataTable({
              
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.home2_box_list') }}",
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false
                    },
                    {
                        data: 'box_heading',
                        name: 'box_heading'
                    },
                    {
                        data: 'box_content',
                        name: 'box_content'
                    },
                    {
                        data: 'icon',
                        name: 'icon',render: function (data, type, row, meta) {
                          
                          return '<img src="{{$url_aws}}home2_box/'+data+'" alt="img" height="50px">';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });   

    });
</script>

@endpush
