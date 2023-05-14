
@extends('admin.layout.app')

@section('content')
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
            <h4 class=""><span style="border-bottom: 4px solid #6773ff;">Badges </span></h4>
          </div>
          <div class="col-6">
            <div style="float:right !important ;margin: 15px 0px 0px 0px"><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addawards">
             {{ __('lang.addaward')}}
            </button> </div></div>
            <!-- Modal -->
            <div class="modal fade" id="addawards" tabindex="-1" aria-labelledby="folderLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="folderLabel">Add Badge</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                  </div>
                  <form action="{{route('admin.award.create')}}" method="post" enctype="multipart/form-data">
                      @csrf
                  <div class="modal-body">                                            
                        <div class="form-group">
                         <label id="folderLabel">{{ __('lang.name')}}</label>
                         <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                         <label id="folderLabel">{{ __('lang.icon')}}</label>
                         <input type="file" name="icon" class="form-control">
                        </div>
                       
                        <div class="form-group">
                         <label id="folderLabel">{{ __('lang.tokens')}}</label>
                         <input type="text" name="tokens" class="form-control">
                        </div>   
                           
                    </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('lang.close')}}</button>
                    <button type="submit" id="submit" class="btn btn-primary">{{ __('lang.submit')}}</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>           
        </div>       
      <div class="row">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard tables_design_space_fix">
                <div class="table-responsive">
                    <table class="data-table table">
                        <thead>
                            <tr>
                                <th>{{__('lang.#') }}</th>
                                <th>{{ __('lang.name') }}</th>
                                <th>{{ __('lang.icon') }}</th>
                                <th>{{ __('lang.tokens') }}</th>
                                <th>{{ __('lang.action') }}</th>
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


@endsection
@push('scripts')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.award.list') }}",
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'icon',
                        name: 'icon',
                        render: function (data, type, row, meta) {
                            var icon = row['icon'];
                            var img = '<img src="{{$url_aws}}awards/'+icon+'" height="50px" alt="image">';
                            return img;
                        }
                    },
                    {
                        data: 'tokens',
                        name: 'tokens'
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
