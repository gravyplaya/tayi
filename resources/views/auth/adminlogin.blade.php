<?php  
  $appname=\App\Models\Setting::where('name','app_name')->first()->value;
  $logo=\App\Models\Setting::where('name','logo')->first()->value;
  $footer_logo=\App\Models\Setting::where('name','footer_logo')->first()->value;
  $favicon=\App\Models\Setting::where('name','favicon')->first()->value;
  $routee=$title ??"";
       $storage= \DB::table('image_spaces')
                    ->first();

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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Codefuse">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="shortcut icon" href="{{$url_aws}}admin/{{$favicon}}">
    <title> {{$appname}}</title>    
    <link rel="stylesheet" href="{{url('user_assets/assets/css/style-s2.css?v1.1.0')}}">
</head>

<body class="nk-body" data-menu-collapse="lg">
    <div class="nk-app-root ">
        <main class="nk-pages">
            <div class="min-vh-100 d-flex flex-column has-mask">
                <div class="nk-mask bg-pattern-dot bg-blend-around"></div>
                <div class="text-center mt-6 mb-4">
                    <a href="{{url('/')}}" class="logo-link">
                        <div class="logo-wrap">
                            <img class="logo-img logo-dark" src="{{$url_aws}}admin/{{$footer_logo}}" srcset="{{$url_aws}}admin/{{$footer_logo}}" alt="">
                          </div>
                    </a>
                </div>
                <div class="my-auto">
                    <div class="container">
                        <div class="row g-gs justify-content-center">
                            <div class="col-md-7 col-lg-6 col-xl-5">
                                <div class="card border-0 shadow-sm rounded-4">
                                    <div class="card-body">
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
                                       
                                        <h4 class="mb-3">Admin Login</h4>
                                        <form  method="post" action="{{ route('admin.login') }}" >
                                          @csrf
                                            <div class="row g-4">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="email">Email or Username</label>
                                                        <div class="form-control-wrap">
                                                            <input type="email" name="email" id="email"class="form-control form-control-lg" placeholder="Enter Email" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- .col -->
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="toggle-password">Password</label>
                                                        <div class="form-control-wrap">
                                                            <a href="toggle-password" class="form-control-icon end password-toggle" title="Toggle show/hide password">
                                                                <em class="on icon ni ni-eye text-base"></em>
                                                                <em class="off icon ni ni-eye-off text-base"></em>
                                                            </a>
                                                            <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" id="toggle-password" placeholder="Enter Password" required>
                                                            @error('password')
                                                              <span class="invalid-feedback" role="alert">
                                                                  <strong>{{ $message }}</strong>
                                                              </span>
                                                             @enderror
                                                          </div>
                                                    </div>
                                                </div>
                                                <!-- .col -->                                              
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <button class="btn btn-primary btn-block" type="submit" >Login</button>
                                                    </div>
                                                </div><!-- .col -->
                                               
                                            </div>
                                            <!-- .row -->
                                        </form>
                                    </div>
                                </div><!-- .card -->
                            </div>
                        </div>
                    </div><!-- .container -->
                </div><!-- .section -->
                <p class="text-center text-heading mt-4 mb-6">&copy; 2023 {{$appname}} </p>
            </div>
        </main>
    </div>
    <script src="{{url('user_assets/assets/js/bundle.js?v1.1.0')}}"></script>
    <script src="{{url('user_assets/assets/js/scripts.js?v1.1.0')}}"></script>
</body>

</html>