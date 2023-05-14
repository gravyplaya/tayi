
<style>
  .sidebar .sidebar-body .nav.sub-menu .nav-item .nav-link.active {
    color: black;
}
.activate{
  color: #6571ff !important;
}


</style>
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
@php($logo=\App\Models\Setting::where('name','logo')->first()->value)
@php($footer_logo=\App\Models\Setting::where('name','footer_logo')->first()->value)
<nav class="sidebar">
      <div class="sidebar-header">
        <a href="{{route('admin.dashboard')}}" class="sidebar-brand">
          <img src="{{$url_aws}}admin/{{$footer_logo}}" alt="" style="width:100px; max-height:100px">
        </a>
        <div class="sidebar-toggler not-active">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>


      <div class="sidebar-body">
        <ul class="nav">
          <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link">
              <i class="link-icon" data-feather="compass"></i>
              <span class="link-title">Dashboard</span>
            </a>
          </li>
          
       <li class="nav-item nav-category">Reports</li>
           <li class="nav-item">
            <a href="{{route('admin.populartools')}}" class="nav-link">
              <i class="link-icon" data-feather="calendar"></i>
              <span class="link-title">Most Used Tools</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.liked_disliked_report')}}" class="nav-link">
              <i class="link-icon" data-feather="thumbs-up"></i>
              <span class="link-title">User like/dislike Reports</span>
            </a>
          </li>
           
           <li class="nav-item nav-category">Membership/Top-Ups</li>
           <li class="nav-item">
            <a href="{{route('admin.membership.list')}}" class="nav-link">
              <i class="link-icon" data-feather="percent"></i>
              <span class="link-title">Memberships</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.plan.list')}}" class="nav-link">
              <i class="link-icon" data-feather="percent"></i>
              <span class="link-title">Word Top-up Plans</span>
            </a>
          </li>
           <li class="nav-item nav-category">Category Management</li>
           <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#category" role="button" aria-expanded="false" aria-controls="category">
              <i class="link-icon" data-feather="mail"></i>
              <span class="link-title">Categories</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="category">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{route('admin.category.list')}}" class="nav-link">Category List</a>
                </li>
                 <li class="nav-item">
                  <a href="{{route('admin.category.add')}}" class="nav-link">Add Category</a>
                </li>
              </ul>
            </div>
          </li>

           <li class="nav-item nav-category">Prompt Management</li>
           <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
              <i class="link-icon" data-feather="mail"></i>
              <span class="link-title">Prompts</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="emails">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{route('admin.template.list')}}" class="nav-link">Prompt List</a>
                </li>
                 <li class="nav-item">
                  <a href="{{route('admin.template.add')}}" class="nav-link">Add Prompt</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item nav-category">Language Management</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#users" role="button" aria-expanded="false" aria-controls="users">
              <i class="link-icon" data-feather="users"></i>
              <span class="link-title">Languages</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="users">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{route('admin.language.list')}}" class="nav-link">language List</a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.language.add')}}" class="nav-link">Add New Language</a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item nav-category">Badges Management</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#awards" role="button" aria-expanded="false" aria-controls="awards">
              <i class="link-icon" data-feather="users"></i>
              <span class="link-title">Badges</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="awards">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{route('admin.award')}}" class="nav-link">Badges list</a>
                </li>
               
              </ul>
            </div>
        </li>
          <li class="nav-item nav-category">User Management</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#useras" role="button" aria-expanded="false" aria-controls="useras">
              <i class="link-icon" data-feather="users"></i>
              <span class="link-title">Users</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="useras">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{route('admin.user.list')}}" class="nav-link">User List</a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.user.add')}}" class="nav-link">Add New User</a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a href="{{route('admin.user.docs')}}" class="nav-link">
              <i class="link-icon" data-feather="folder"></i>
              <span class="link-title">Projects</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin.user.history')}}" class="nav-link">
              <i class="link-icon" data-feather="file"></i>
              <span class="link-title">Generated History</span>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{route('admin.user.transactions')}}" class="nav-link">
              <i class="link-icon" data-feather="file"></i>
              <span class="link-title">Transactions</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#notifications" role="button" aria-expanded="false" aria-controls="notifications">
              <i class="link-icon" data-feather="users"></i>
              <span class="link-title">{{ __('lang.notification')}}</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>           
            <div class="collapse" id="notifications">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{route('admin.notification')}}" class="nav-link">{{ __('lang.notification')}}</a>  
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.notification.email')}}" class="nav-link">{{ __('lang.sendmail')}}</a>
                </li>
              </ul>
            </div>
</li>

          <li class="nav-item nav-category">Main Settings</li>
          <li class="nav-item">
            <a href="{{route('admin.settings.index')}}" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Settings</span>
            </a>
          </li>
			<li class="nav-item">
            <a href="{{route('admin.edithomepage')}}" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Website Settings</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.payment_gateway.index')}}" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Payment Gateway Settings</span>
            </a>
          </li>
         
        </ul>
      </div>
    </nav>
   



