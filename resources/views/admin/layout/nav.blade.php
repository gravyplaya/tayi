
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
<nav class="navbar">
        <a href="#" class="sidebar-toggler">
          <i data-feather="menu"></i>
        </a>
        <div class="navbar-content">
             
          <ul class="navbar-nav">
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="{{route('admin.edit-admins-profile')}}" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="wd-30 ht-30 rounded-circle" src="{{url('storage/app/public/user/')}}/{{auth('admin')->user()->image}}" alt="profile">
              </a>
              <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                  <div class="mb-3">
                    <img class="wd-80 ht-80 rounded-circle" src="{{$url_aws}}user/{{auth('admin')->user()->image}}" alt="">
                  </div>
                  <div class="text-center">
                    <p class="tx-16 fw-bolder">{{auth('admin')->user()->name}}</p>
                    <p class="tx-12 text-muted">{{auth('admin')->user()->email}}</p>
                  </div>
                </div>
                <ul class="list-unstyled p-1">
                
                  <li class="dropdown-item py-2">
                    <a href="{{route('admin.edit-admins-profile')}}" class="text-body ms-0">
                      <i class="me-2 icon-md" data-feather="edit"></i>
                      <span>Edit Profile</span>
                    </a>
                  </li>
                  
                  <li class="dropdown-item py-2">
                    <form action="{{ route('admin.logout') }}" method="post">
                                @csrf
                                <i class="me-2 icon-md" data-feather="log-out"></i> <input type="submit" class="text-body ms-0" value="Log Out" style="background: none;border: none;margin-left: -5px !important;">    
                            </form>
                  
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </nav>