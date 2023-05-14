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
                <div class="card-title"> Edit FAQ Section </div>
            </div>
            <div class="card-body">
            <form class="form-group" action="{{route('admin.faq_update',$faq_edit->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label id="folderLabel">Question</label>
                    <input type="text" name="question"  class="form-control" value="{{ $faq_edit->question}}">
                   </div>                
                  
                   <div class="form-group mb-3">
                    <label id="folderLabel">Answer</label>
                    <input type="text" name="answer" class="form-control" value="{{ $faq_edit->answer}}">
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
    

@endpush
    