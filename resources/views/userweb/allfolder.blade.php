
@extends('userweb.layout.app')

@section('content')
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
      <div class="container">
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
          <div class="col-6">
            <h4 class="mb-3 mb-md-0"><span style="border-bottom: 4px solid #6773ff;">Folders</span></h4>
          </div>
          <div class="col-6">


            <div style="float:right !important"><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#folder">
             Add Folder
            </button> </div></div>
            <!-- Modal -->
            <div class="modal fade" id="folder" tabindex="-1" aria-labelledby="folderLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="folderLabel">Folder</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                  </div>
                  <form action="{{route('create_folder')}}" method="post">
                      @csrf
                  <div class="modal-body">

                      <div class="form-group">
                         <label id="folderLabel">Folder Name</label>
                         <input type="text" name="name" class="form-control" placeholder="Enter Folder Name">
                       </div>


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Folder</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
       </div>

   <div class="row">
          <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">

           <div class="d-flex">
              @php($folder=\App\Models\Folder::where('user_id', auth()->user()->id)->get())
              @if(count($folder)>0)
                  @foreach($folder as $foll)
           <a href="{{ route('folder_project') }}?folder_id={{ $foll->id }}">

                                    <div class="btn btn-outline-primary folder mr-3 text-black"
                                        style="margin-right: 4px;border:none">

                                        <center><img src="{{ url('user_assets/images/folder.png') }}" alt="img"
                                                style="width:80px">
                                            <p> <b style="color:black">{{ $foll->name }}</b> &nbsp; &nbsp;</p>
                                        </center>

                                    </div>
                                </a>
              @endforeach
              @else
              <center>No folder Avaiable</center>

              @endif
               </div>

            </div>
          </div>
        </div> <!-- row -->

    </div>


      @endsection
