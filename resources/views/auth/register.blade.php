<?php

$logo=\App\Models\Setting::where('name','logo')->first()->value;
$footer_logo=\App\Models\Setting::where('name','footer_logo')->first()->value;
$appname=\App\Models\Setting::where('name','app_name')->first()->value;
$favicon=\App\Models\Setting::where('name','favicon')->first()->value;
$facebook=\App\Models\Setting::where('name','facebook')->first()->value;
$twitter=\App\Models\Setting::where('name','twitter')->first()->value;
$google=\App\Models\Setting::where('name','google')->first()->value;
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
	<style>
		/* add appropriate colors to fb, linkedin and google buttons */
.fb,.fb:hover {
  background-color: #3B5998;
  color: white;
}

.linkedin,.linkedin:hover {
  background-color: #0A66C2;
  color: white;
}

.google,.google:hover {
  background-color: #dd4b39;
  color: white;
}
input {
    border: 1px solid lightgrey;
}

	</style>
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
                                      <div class="text-center">
                                        @if($routee !="Admin" && $routee !="admin")
                                           <a href="{{ url('auth/facebook') }}" class="fb btn mb-3" style="width:100% !important">
											  <i class="fa fa-facebook fa-fw"></i> Login with Facebook
											 </a><br>
											<a href="{{ url('auth/linkedin') }}" class="linkedin btn mb-3"  style="width:100% !important">
											  <i class="fa fa-linkedin fa-fw"></i> Login with linkedin
											</a><br>
											<a href="{{ url('login/google') }}" class="google btn mb-3"  style="width:100% !important"><i class="fa fa-google fa-fw">
											  </i> Login with Google+
											</a>
                                       <span class="divider">or</span>
                                         @else
                                         <span class="divider"></span>
                                         @endif
                                      </div>
                                        <h4 class="mb-3">Create an account</h4>
                                        <form action="{{url('register')}}"  method="POST" novalidate>
                                          @csrf
                                            <div class="row g-4">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="fullname">Full Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" name="name" id="fullname" class="form-control form-control-lg" placeholder="Enter Your Full Name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="emailaddress">Email Address</label>
                                                        <div class="form-control-wrap">
                                                            <input type="email" name="email" id="emailaddress" class="form-control form-control-lg" placeholder="name@copygen.com" required>
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
                                                            <input type="password" name="password" id="toggle-password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Enter Password" required>
                                                        </div>
                                                    </div>
                                                </div><!-- .col -->
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="toggle-password">Confirm Password</label>
                                                        <div class="form-control-wrap">
                                                            <a href="toggle-cnf_password" class="form-control-icon end password-toggle" title="Toggle show/hide password">
                                                                <em class="on icon ni ni-eye text-base"></em>
                                                                <em class="off icon ni ni-eye-off text-base"></em>
                                                            </a>
                                                            <input type="password" name="password_confirmation" id="toggle-cnf_password" class="form-control form-control-lg" placeholder="Enter Confirm Password" required>
                                                        </div>
                                                    </div>
                                                </div><!-- .col -->
                                               
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <button class="btn btn-primary btn-block" type="submit" id="submit-btn">Create Account</button>
                                                    </div>
                                                </div><!-- .col -->
                                                <div class="col-12 text-center">                                                 
                                                    <p class="mt-4">Already have an account? <a href="{{route('login')}}">Login</a></p>
                                                </div><!-- .col -->
                                            </div><!-- .row -->
                                        </form>
                                    </div>
                                </div><!-- .card -->
                            </div>
                        </div>
                    </div><!-- .container -->
                </div><!-- .section -->
                <p class="text-center text-heading mt-4 mb-6">&copy; 2023 {{$appname}}</p>
            </div>
        </main>
    </div>
    <script src="{{url('user_assets/assets/js/bundle.js?v1.1.0')}}"></script>
    <script src="{{url('user_assets/assets/js/scripts.js?v1.1.0')}}"></script>
</body>

</html>