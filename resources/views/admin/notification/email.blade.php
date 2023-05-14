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

  <!-- include summernote css -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> 

    <div class="row">
        <div class="col">
         <div class="card">
             <div class="card-header">
                 <div class="card-title">{{ __('lang.sendmail')}}</div>
             </div>
             <div class="card-body">
                <form class="form-group" action="{{ route('admin.send.email')}}" enctype="multipart/form-data" method="Post">
                    @csrf
                    <div class="form-group">
                        <label id="folderLabel">{{ __('lang.usertype')}}</label>
                        <select  class="form-control" name="user_type" id="">
                            <option>--select--</option>
                            <option value="0">{{ __('lang.free')}}</option>
                            <option value="1">{{ __('lang.paid')}}</option>
                         </select>
                    </div>
                    <div class="form-group mb-3">
                        <label id="folderLabel">{{ __('lang.subject')}}</label>
                        <input type="text" name="subject" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label class="">{{ __('lang.message')}}</label><br>
                        <textarea class="form-controll" name="message" id="summernote" cols="100" rows=""></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="submit" class="btn btn-primary right">{{ __('lang.sendmail')}}</button>
                    </div>
                </form>
             </div>
         </div>
        </div>
    </div>
@endsection
@push('scripts')
   <!-- Form  summernote JavaScript -->
   <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
$(document).ready(function() {
  
    $('#summernote').summernote();
});

</script>
@endpush