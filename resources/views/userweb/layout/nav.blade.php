
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



    <style>
    .dropdown-menu.p-0.show {
    height: 50vh;
    overflow-y: scroll;
}
.tags {
  display: inline;
  position: relative;
}

.tags:hover:after {
  background: #333;
  background: rgba(237, 227, 227, 0.8);
  border-radius: 5px;
  bottom: -34px;
  color: #0e0e0e;
  content: attr(title1);
  left: 20%;
  padding: 5px 15px;
  position: absolute;
  z-index: 98;
  width: 150px;
}

.tags:hover:before {
  border: solid;
  border-color: #333 transparent;
  border-width: 0 6px 6px 6px;
  bottom: -4px;
  content: "";
  left: 50%;
  position: absolute;
  z-index: 99;
}

</style>
<?php


$get_user_details=\App\Models\User::where('id',auth()->user()->id)->first();
$get_user_plan_details=\App\Models\SubMembership::with('mem')->where('id',$get_user_details->plan_id)->first();
$userawards = \App\Models\UserAward::where('user_id',auth()->user()->id)->get();
if(count($userawards)>0){
foreach ($userawards as $key => $useraward) {
   $awardId[]= $useraward->award_id;
}
$awdnames = \App\Models\Award::whereiN('id',$awardId)->get();
}
else{
  $awdnames=[];  
}
?>
<nav class="navbar">
    <a href="#" class="sidebar-toggler"><i data-feather="menu"></i></a>
    <div class="navbar-content">
        <ul class="navbar-nav">
          
				<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i data-feather="bell"></i>
								@php($user_noti=\App\Models\User_Notification::where(['user_id'=> auth()->user()->id,'status'=> 0])->get())
								@if(count($user_noti)>0)
								<div class="indicator">
									<div class="circle"></div>
								</div>
								@endif
							</a>
							<div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
								<div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
									
								</div>
                <div class="p-1">
					
					<ul class="list-unstyled p-1">
                        <?php
                            $user = auth()->user();
                                $user_noti=\App\Models\User_Notification::where(['user_id'=> $user->id,'status'=> 0])->get();
                                $user_noti_id=[];
                                foreach ($user_noti as $key => $user_n) {
                                  $user_noti_id[]=$user_n->noti_id;
                                }
                                $notification = \App\Models\Notification::whereIn('id',$user_noti_id)->get();
                           
                            foreach ($notification as $key => $noti) {
                        ?>
                            <li>
								
                            <div class="row container" style="border: 2px solid {{ $noti->color}}; margin:1px;">
                                <div class="col-4 p-2"  style="float: left">
                                    @if ($noti->icon)
                                        <img class="" src="{{$url_aws.'noti_image/'.$noti->icon}}" alt="image" style="max-width:30px; max-height:30px;">
                                    @else
                                    <img src="{{$url_aws.'admin/'.$favicon}}" alt="Image" style="max-width:30px; max-height:30px;">
                                    @endif
                                </div>
                                <div class="col-8 p-2">
                                    <b>{{$noti->title}}</b>
                                    <a href="{{route('readnoti',$noti->id)}}"><i class="link-icon text-danger" data-feather="x-circle" style="float:right; margin:-5 -16px 0 0;"></i></a> <br>
                                    <a href="{{$noti->noti_url}}"> {{$noti->discrtiption}} </a>
                                </div>
                            </div>
                            </li>
                        <?php  } ;?>
                       
                    </ul>
                  
                </div>
								
							</div>
						</li>
            
            <div class="mb-0">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#changelang">
                    <i class="link-icon" data-feather="globe"></i>
                </button>
            </div>

          <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <button class="btn btn-primary">Create Content</button> 
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown" >
                    
                    <ul class="list-unstyled p-1">
                      @php($tools = \App\Models\Template::get())
                        @foreach ($tools as $tool)
                            <li class="dropdown-item py-2">
                                <a class="text-body ms-0"  @if($get_user_details->plan_id != 5)  href="{{route('ai', $tool->slug)}}"   @else @if($tool->premium==1 && $get_user_details->plan_id != 5) href="{{ route('ai', $tool->slug) }}" @elseif($tool->premium==0 && $get_user_details->plan_id == 5) href="{{ route('ai', $tool->slug) }}" @else data-bs-toggle="modal" data-bs-target="#upgradeplan"  @endif @endif>
                                  <div class="d-flex"><img
                                                src="{{ $url_aws }}icon/{{ $tool->icon }}"
                                                style="width:20px;height:20px;margin-top: 3px;"> &nbsp; &nbsp; {{ $tool->name }}</div> 
                                </a>
                            </li>
                        @endforeach 
                       
                    </ul>
                </div>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="wd-30 ht-30 rounded-circle" src="{{$url_aws}}user/{{auth()->user()->image}}" alt="profile">
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <img class="wd-80 ht-80 rounded-circle" src="{{$url_aws}}user/{{auth()->user()->image}}"
                                alt="">
                        </div>
                        <div class="text-center">
                            <p class="tx-16 fw-bolder">{{ auth()->user()->name }}</p>
                            <p class="tx-12 text-muted">{{ auth()->user()->email }}</p>
                        </div>
                    </div>   
                    <div class="m-2">     
                    @if(count($awdnames)>0)            
                      @foreach ($awdnames as $awd)
                     <a class="tags" title1="{{ $awd->tokens.' words used' }}"> <img src="{{$url_aws.'awards/'.$awd->icon}}" alt="" style="max-width:30px;max-height:30px"></a>
                      
                      @endforeach
                      @endif
                    </div>
                    <ul class="list-unstyled p-1">
                        <li class="dropdown-item py-2">
                            <a href="{{ route('billing') }}" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="edit"></i>
                                <span>Billing</span>
                            </a>
                        </li>

                        <li class="dropdown-item py-2">
                            <a href="{{ route('edit-user-profile') }}" class="text-body ms-0">
                                <i class="me-2 icon-md" data-feather="edit"></i>
                                <span>Edit Profile</span>
                            </a>
                        </li>

                        <li class="dropdown-item py-2">
                            <form action="{{ route('logout') }}" method="post">
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

<!-- Modal -->
<div class="modal fade" id="notification" tabindex="-1" aria-labelledby="changelangLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
           <h5 class="modal-title" id="">Notification</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
            <table class="">
                <thead class="">
                    <th>Title</th>
                    <th>Message</th>
                </thead>
                <tbody class="">                    
                    <td>warnig</td>
                    <td>fvkjfvfjbvfvj</td>
                </tbody>
            </table>
            <div class="modal-footer">
            </div>
      </div>
    </div>
</div>
