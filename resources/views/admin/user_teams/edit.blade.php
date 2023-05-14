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
                <div class="card-title"> Edit Team member</div>
            </div>
            <div class="card-body">
            <form class="form-group" action="{{route('user_team.update',$teams->id)}}" method="post">
                @csrf                    
                <div class="form-group mb-3">
                <label id="folderLabel">Team Member Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Team Member Name" value="{{ $teams->name}}">
                </div>
                <div class="form-group mb-3">
                <label id="folderLabel">Team Member Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Team Member Email" value="{{ $teams->email}}">
                </div>                            
                <div class="form-group mb-3">
                <label id="messages" style="color:red">Token Limit value is high</label><br>
                <label id="folderLabel">Team Member Token Limit</label>
                <input type="number" name="tokens" id="tokenss" class="form-control" placeholder="Enter Team Member Token" value="{{ $teams->tokens }}">
                <input type="hidden" name="maxtoken" id="maxtokens" value="{{ $maxtoken }}">
				<input type="hidden" name="oldtoken" id="oldtokens" value="{{ $teams->tokens }}">
                </div><br>
                <div class="form-group">
                    <button type="submit" id="submits" class="btn btn-primary right">Update Team</button>
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
   $(document).ready(function(){
        let max=  $("#maxtokens").val();
        let oldtoken=  $("#oldtokens").val();
        $("#messages").hide();
        $("#tokenss").keyup(function() {
            var token = $(this).val();
            var alltoken =parseInt(max) + parseInt(oldtoken);
		
                if(alltoken >= token){
                $("#messages").hide();
                $("#submits").attr("disabled", false);
            }else{
                const message = 'Token Limit value is highssaas';
                $("#messages").show();
                $("#submits").attr("disabled", true);
            }
    
        });
       
    });
  </script>
    @endpush
    