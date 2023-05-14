
@extends('admin.layout.app')

@section('content')
<?php
$faq =\App\Models\HowTo::where('name','faq')->select('id','main_content','main_heading','name')->first();
// dd($home2);
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
            <h4 class=""><span style="border-bottom: 4px solid #6773ff;">FAQ section</span></h4>
          </div>
            <div class="col-6">
                <div style="float:right !important ;margin: 15px 0px 0px 0px">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#boxes">Add FAQ</button> 
                </div>
            </div>
            <div style="float:right !important ;margin: 15px 0px 0px 0px">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editsection"> Edit FAQ Section </button> 
            </div>
        </div>
                    
           
      <div class="row">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard tables_design_space_fix">
                <div class="table-responsive">
                    <table class="data-table table ">
                        <thead>
                            <tr>
                                <th>{{__('Sr.No.') }}</th>
                                <th>Question</th>
                                <th>Answer</th>
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
           <h5 class="modal-title" id="folderLabel">FAQ section</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
        <form action="{{route('admin.faq_create')}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="modal-body">
            <div class="form-group">                    
              <div class="row mb-3">
                <div class="col-6">
                    <label for="question">Question </label>
                    <div class="col-sm-12">
                        <input type="text" name="question" class="form-control" id="question" autocomplete="off" value="">
                    </div>
                </div>
                  <div class="col-6">
                      <label for="answer" >Answer </label>
                      <div class="col-sm-12">
                          <input type="text" name="answer" class="form-control" id="answer" autocomplete="off" value="">
                      </div>
                  </div>
                  
              </div>
                                    
             </div> 
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('lang.close')}}</button>
          <button type="submit" id="submit" class="btn btn-primary">Crete FAQ</button>
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
           <h5 class="modal-title" id="folderLabel">FAQ section</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
        <form action="{{route('admin.how_to_section_update',$faq->id)}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="modal-body">
            <div class="form-group">
              <div class="row mb-3">
                  <div class="col-6">
                      <label for="main_heading" >Main Heading</label>
                      <div class="col-sm-12">
                          <input type="text" name="main_heading" class="form-control" id="main_heading" autocomplete="off" value="{{$faq->main_heading}} ">
                      </div>
                  </div>
                  <div class="col-6">
                      <label for="main_content">Main Content</label>
                      <div class="col-sm-12">
                          <input type="text" name="main_content" class="form-control" id="main_content" autocomplete="off" value="{{$faq->main_content}} ">
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
                ajax: "{{ route('admin.faq_list') }}",
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false
                    },
                    {
                        data: 'question',
                        name: 'question'
                    },
                    {
                        data: 'answer',
                        name: 'answer'
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
