<?php ($logo=\App\Models\Setting::where('name','logo')->first()->value); ?>
<?php ($appname=\App\Models\Setting::where('name','app_name')->first()->value); ?>
<?php ($favicon=\App\Models\Setting::where('name','favicon')->first()->value); ?>
<?php ($footer_logo=\App\Models\Setting::where('name','footer_logo')->first()->value); ?>
<?php ($facebook=\App\Models\Setting::where('name','facebook')->first()->value); ?>
<?php ($twitter=\App\Models\Setting::where('name','twitter')->first()->value); ?>
<?php ($google=\App\Models\Setting::where('name','google')->first()->value); ?>
<?php ($routee=$title ??""); ?>
<?php  
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
    <link rel="shortcut icon" href="<?php echo e($url_aws); ?>admin/<?php echo e($favicon); ?>">
    <title> <?php echo e($appname); ?></title>    
    <link rel="stylesheet" href="<?php echo e(url('user_assets/assets/css/style-s2.css?v1.1.0')); ?>">
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
                    <a href="<?php echo e(url('/')); ?>" class="logo-link">
                        <div class="logo-wrap">
                            <img class="logo-img logo-dark" src="<?php echo e($url_aws); ?>admin/<?php echo e($footer_logo); ?>" srcset="<?php echo e($url_aws); ?>admin/<?php echo e($footer_logo); ?>" alt="">
                          </div>
                    </a>
                </div>
                <div class="my-auto">
                    <div class="container">
                        <div class="row g-gs justify-content-center">
                            <div class="col-md-7 col-lg-6 col-xl-5">
                                <div class="card border-0 shadow-sm rounded-4">
                                    <div class="card-body">
                                      <?php if(session()->has('success')): ?>
                                      <div class="alert alert-success">
                                        <?php if(is_array(session()->get('success'))): ?>
                                          <ul>
                                              <?php $__currentLoopData = session()->get('success'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  <li><?php echo e($message); ?></li>
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          </ul>
                                        <?php else: ?>
                                            <?php echo e(session()->get('success')); ?>

                                        <?php endif; ?>
                                      </div>
                                    <?php endif; ?>
                                    <?php if(count($errors) > 0): ?>
                                      <?php if($errors->any()): ?>
                                        <div class="alert alert-danger" role="alert">
                                          <?php echo e($errors->first()); ?>

                                          
                                        </div>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                       <div class="text-center">
                                          <?php if($routee !="Admin" && $routee !="admin"): ?>
                                              <a href="<?php echo e(url('auth/facebook')); ?>" class="fb btn mb-3" style="width:100% !important">
											  <i class="fa fa-facebook fa-fw"></i> Login with Facebook
											 </a><br>
											<a href="<?php echo e(url('auth/linkedin')); ?>" class="linkedin btn mb-3"  style="width:100% !important">
											  <i class="fa fa-linkedin fa-fw"></i> Login with linkedin
											</a><br>
											<a href="<?php echo e(url('login/google')); ?>" class="google btn mb-3"  style="width:100% !important"><i class="fa fa-google fa-fw">
											  </i> Login with Google+
											</a>
                                         <span class="divider">or</span>
                                           <?php else: ?>
                                           <span class="divider"></span>
                                           <?php endif; ?>
                                        </div>
                                        <h4 class="mb-3">Welcome Back!</h4>
                                        <form  method="post" action="<?php echo e(route('login')); ?>">
                                          <?php echo csrf_field(); ?>
                                            <div class="row g-4">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="email">Email</label>
                                                        <div class="form-control-wrap">
                                                            <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Enter Email" required>
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
                                                            <input type="password" class="form-control form-control-lg <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" id="toggle-password" placeholder="Enter Password" required>
                                                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                              <span class="invalid-feedback" role="alert">
                                                                  <strong><?php echo e($message); ?></strong>
                                                              </span>
                                                             <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                          </div>
                                                    </div>
                                                </div>
                                                <!-- .col -->
                                                <div class="col-12">
                                                    <div class="d-flex flex-wrap justify-content-between has-gap g-3 float-end">                                                        
                                                        <a href="<?php echo e(route('password.request')); ?>" class="small">Forgot Password?</a>
                                                    </div>
                                                </div><!-- .col -->
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <button class="btn btn-primary btn-block" type="submit" id="submit-btn">Login</button>
                                                    </div>
                                                </div><!-- .col -->
                                                <div class="col-12 text-center">                                                  
                                                    <p class="mt-4">Don't have an account? <a href="<?php echo e(url('register')); ?>">Register</a></p>
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
                <p class="text-center text-heading mt-4 mb-6">&copy; 2023 <?php echo e($appname); ?></p>
            </div>
        </main>
    </div>
    <script src="<?php echo e(url('user_assets/assets/js/bundle.js?v1.1.0')); ?>"></script>
    <script src="<?php echo e(url('user_assets/assets/js/scripts.js?v1.1.0')); ?>"></script>
</body>

</html><?php /**PATH C:\xampp\htdocs\tayiwithoutinstaller\resources\views/auth/login.blade.php ENDPATH**/ ?>