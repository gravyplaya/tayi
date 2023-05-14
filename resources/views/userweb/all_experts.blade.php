@extends('userweb.layout.app')
@php($get_user_details=\App\Models\User::where('id',auth()->user()->id)->first())
@php($get_user_plan_details=\App\Models\SubMembership::with('mem')->where('id',$get_user_details->plan_id)->first())
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <div class="container">

        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow-1">
                    <div class="row">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Search
        </h2>
    </x-slot>

    <div>
        <div class="row" id="">
            <div class="col-md-12 grid-margin dashboard" style="margin-top:10px">
                <div class="card">
                     <div class="card-header">
                <div class="card-title">
                    <h1 style="text-align: left;font-size: 30px;">All Experts</h1>
                    
                </div>
            </div>

                <div class="card-body" >
                                       <div class="row">
                                    
                                    @foreach ($framework_details as $tool)
                                    <div class="col-md-3 col-xl-3 col-sm-12 col-xs-12 col-lg-3 grid-margin">
                                        <div class="card mb-3" style="max-width: 540px;border:2px solid yellow">
                                      <div class="row g-0">
                                        <div class="col-md-4">
                                          <img src="{{ url('storage/app/public/icon/') }}/{{ $tool->chat_icon }}" class="img-fluid rounded-start" alt="..." style="height:100%">

                                        </div>
                                         <div class="col-md-8">
                                              <div class="card-body">
                                                <h5 class="card-title">{{$tool->name}}</h5>
                                                <p class="card-text">{{Str::limit($tool->description,20)}}</p>
                                                <a href="">Start new chat</a>
                                              </div>
                                        </div>
                                      </div>
                                    </div>
                                                                                    
                                    </div>
                                @endforeach

                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
        </div>
    </div>

@endsection
