 
@extends('userweb.layout.app')

@section('content')

  <div class="row">


        @foreach($templates as $templa)
        
        <div class="d-flex col-xl-3 col-sm-6 mb-xl-4 mb-4">
          <div class="card w-100">
            <a class="nav-link" href="{{url('formm?id=')}}{{$templa->id}}">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-3 text-capitalize font-weight-bold">{{$templa->name}}</p>
                    <p>
                    {{$templa->description}}
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center items-center border-radius-md">
                    <center><img src="{{url('storage/app/public/icon/')}}/{{$templa->icon}}" style="width:40px;height:40px;margin-top: 3px;"></center>
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>
        </div>
      

    @endforeach
      </div>
      
      
      

      @endsection