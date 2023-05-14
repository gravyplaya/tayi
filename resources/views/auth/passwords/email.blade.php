<?php   
  $logo=\App\Models\Setting::where('name','logo')->first()->value;
  $appname=\App\Models\Setting::where('name','app_name')->first()->value;
  $favicon=\App\Models\Setting::where('name','favicon')->first()->value;
$footer_logo=\App\Models\Setting::where('name','footer_logo')->first()->value;
  $routee=$title ??"";
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
                            <img class="logo-img logo-dark" src="{{$url_aws}}admin/{{$footer_logo}}" srcset="{{$url_aws}}admin/{{$footer_logo}}" alt="" style="max-width:150px">
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
                                    
                                           <h4 class="text-center">Reset password</h4>
                                           <p>If you forgot your password, well, then we’ll email you instructions to reset your password.</p>
                                           <form method="POST" action="{{ route('password.email') }}">
                                            @csrf
                                               <div class="row g-4">
                                                   <div class="col-12">
                                                       <div class="form-group">
                                                           <label class="form-label" for="emailorusername">Email Address</label>
                                                           <div class="form-control-wrap">
                                                               <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Enter Email" required>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <!-- .col -->
                                                   <div class="col-12">
                                                       <div class="d-flex flex-wrap justify-content-between align-items-center has-gap g-3">
                                                           <div class="form-group">
                                                               <button class="btn btn-primary" type="submit" id="submit-btn" >Send Password Reset Link</button>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                               <!-- .row -->
                                           </form>
                                       </div>
                                   </div><!-- .card -->
                                   <p class="text-center mt-4"><a class="link has-gap g-2" href="{{route('login')}}"><em class="icon ni ni-arrow-left"></em><span>Back to Login</span></a></p>
                               </div>
                           </div>
                       </div><!-- .container -->
                   </div><!-- .section -->
                   <p class="text-center text-heading mt-4 mb-6">&copy; 2023 {{$appname}}. Template Made By <a target="_blank" href="{{ url('/') }}">{{$appname}}</a> </p>
               </div>
           </main>
       </div>
       <script src="{{url('user_assets/assets/js/bundle.js?v1.1.0')}}"></script>
       <script src="{{url('user_assets/assets/js/scripts.js?v1.1.0')}}"></script>
   </body>
   
  </html>


