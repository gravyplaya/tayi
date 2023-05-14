<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .sidebar .sidebar-body .nav.sub-menu .nav-item .nav-link.active {
        color: black;
    }

    .activate {
        color: #6571ff !important;
    }

    .progress-bar {
        background-color: #55B589 !important;
    }

    .btn {
        display: flex;
        align-items: center;
    }


    .plan-credits {
        display: flex;
        justify-content: space-between;
        letter-spacing: -0.01em;
        color: #667085;
    }

    .upgrade-area {
        margin-top: 15px;
    }

    .btn.btn-primary {
        color: white;
        background: #2e16e6;
        font-weight: 600;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        letter-spacing: -.02em;
        text-align: center;
    }


    .active {
        background: #EEEDFA;
        border-radius: 6px;
        color: #2E16E6;
    }

    .left-upper-menu a svg {
        width: 18px;
        margin-right: 15px;
    }

    .progress-area {
        font-size: 14px;
        width: 216px;
        margin: 0 auto 25px;
    }
     svg {
    vertical-align: inherit;
}
	
	@media (min-width:961px)  { 
	  .sidebar-toggler{
		  display:none !important;
		}
	}
  @media (min-width:1025px) {
	 .sidebar-toggler{
		  display:none !important;
		}
	}
  @media (min-width:1281px) {  
	.sidebar-toggler{
		  display:none !important;
		}
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
        <a href="{{ route('user_dashboard') }}" class="sidebar-brand">
           <img src="{{$url_aws}}admin/{{$footer_logo}}" alt="" style="width:100px; max-height:100px">
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>


    <div class="sidebar-body">

        <?php
        $mem_id = auth()->user()->plan_id;
$submem= \App\Models\SubMembership::with('mem')->where('id',$mem_id)->first();
$checkuser=\App\Models\User::Where('id',auth()->user()->id)->first();
     
$chckktokens=$checkuser->tokens;
$rem_tokens= $checkuser->tokens - $checkuser->token_reached; 
if($chckktokens != 0 && $chckktokens != NULL){
$percentage=($rem_tokens*100)/$chckktokens;
}
$now=date('Y-m-d');
$earlier = new DateTime($now);
$later = new DateTime($checkuser->plan_end);

$abs_diff = $later->diff($earlier)->format("%a");
$planend = strtotime(auth()->user()->plan_end);
$today = strtotime(date('Y-m-d'));
?>
@php($get_user_details=\App\Models\User::where('id',auth()->user()->id)->first())
@php($get_user_plan_details=\App\Models\SubMembership::with('mem')->where('id',$get_user_details->plan_id)->first())
        <ul class="nav">

            <li>
                <div class="plan-credits" >
                    <strong class="plan text-nowrap">@if($mem_id == 5 || $planend >= $today) Free Plan @else {{$get_user_plan_details->type}} Plan @endif</strong>
                    <div class="flex" style="font-size: 12px !important;">
                        <strong class="flex" data-totalplan="{{$rem_tokens}}">{{$rem_tokens}} </strong> &nbsp; words left
                    </div>
                </div>
                @if($checkuser->tokens != 0 || $checkuser->tokens!= NULL)
                <div class="progress">
                  <div class="progress-bar" role="progressbar" style="width: <?php echo $percentage; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="background-color: #55B589; height:100%;"></div>
                </div>
             
                @endif
            </li>
            <li>
       @if(!Auth::user()->user_id)
               <div class="row">
                <div class="col-4">
               <div class="upgrade-area" style="margin-top: 10px !important;">

                    <div class="mb-0" style="font-size:14px;margin-top: 10px !important;"><button
                            type="button" class="btn btn-success"
                            data-bs-toggle="modal" data-bs-target="#upgradetokens" style="white-space: nowrap;text-align: center;padding: 6px;margin-top: 11px;background: #f96509;border:1px solid #f96509;">
                            Top-Up &nbsp;

                        </button> </div>
                </div>
               </div>
                  <div class="col-8">
                <div class="upgrade-area" style="margin-top: 10px !important;">

                    <div class="mb-0" style="margin-top: 10px !important;"><button
                            style="text-align: center" type="button" class="btn btn-custom"
                            data-bs-toggle="modal" data-bs-target="#upgradeplan"  @if($mem_id != 5 ) disabled @endif style="white-space: nowrap;text-align: center;">
                            @if($mem_id != 5 && $planend >= $today) {{$submem->type}} Plan @else Upgrade ⚡ @endif &nbsp;

                            

                        </button> </div>
                </div></div></div>
                @endif
            </li>
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item p-1">
                <a href="{{ route('user_dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
          <li class="nav-item mt-1  p-1">
                <a href="{{route('all_toolss')}}" class="nav-link">
                    <i class="link-icon" data-feather="layers"></i>
                    <span class="link-title">All Tools</span>
                </a>
            </li>
            <li class="nav-item mt-1  p-1">
                <a href="{{ route('mycontent') }}" class="nav-link">
                   <i class="link-icon"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M19,3H12.472a1.019,1.019,0,0,1-.447-.1L8.869,1.316A3.014,3.014,0,0,0,7.528,1H5A5.006,5.006,0,0,0,0,6V18a5.006,5.006,0,0,0,5,5H19a5.006,5.006,0,0,0,5-5V8A5.006,5.006,0,0,0,19,3ZM5,3H7.528a1.019,1.019,0,0,1,.447.1l3.156,1.579A3.014,3.014,0,0,0,12.472,5H19a3,3,0,0,1,2.779,1.882L2,6.994V6A3,3,0,0,1,5,3ZM19,21H5a3,3,0,0,1-3-3V8.994l20-.113V18A3,3,0,0,1,19,21Z"></path></svg></i>
                    <span class="link-title">My Content</span>
                </a>
            </li>
         

            <li class="nav-item mt-1  p-1">
                <a href="{{ route('all_folders') }}" class="nav-link">
                    <i class="link-icon" data-feather="folder"></i>
                    <span class="link-title">Folders</span>
                </a>
            </li>
            @if(!Auth::user()->user_id && $get_user_details->plan_id != 5)
            <li class="nav-item mt-1  p-1">
                <a href="{{ route('team') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Team</span>
                </a>
            </li>
           @endif


          <li class="nav-item nav-category">Tools</li> 
           @if($submem->mem->image ==1)
             <li class="nav-item mt-1  p-1">
                <a href="{{ route('ai', 'ai_images') }}" class="nav-link">
                    <i class="link-icon" data-feather="image"></i>
                    <span class="link-title">AI Images</span>
                </a>
            </li> 
            @endif
			
		 @php($image_model = \App\Models\Setting::where('name', 'image_model')->first()->value)
		   @if($image_model != "dall")
			 <li class="nav-item mt-1  p-1">
                <a href="{{ route('ai', 'image_editor') }}" class="nav-link">
                    <i class="link-icon" data-feather="crop"></i>
                    <span class="link-title">Image Editor</span>
                </a>
            </li> 
			@endif

            @if($submem->mem->article ==1)
            <li class="nav-item mt-1  p-1">
                <a href="{{ route('article_generator') }}" class="nav-link">
                  <i class="link-icon" data-feather="cpu"></i>
                    <span class="link-title">Write an Article</span>
                </a>
            </li> 
            @endif

             <li class="nav-item mt-1  p-1">
                <a href="{{route('open_chat')}}" class="nav-link" disabled>
                   <i class="link-icon" data-feather="message-square"></i>
                    <span class="link-title">Chat</span>
                </a>
            </li>
            
             <li class="nav-item mt-1  p-1">
                <a href="{{route('audio')}}" class="nav-link" disabled>
                   <i class="link-icon" data-feather="headphones"></i>
                    <span class="link-title">Audio To Text</span>
                </a>
            </li>
            
     

             <li class="nav-item nav-category">Templates</li> 
    

         @php($category=\App\Models\Category::with('templates')->get())
               @foreach($category as $cat)
               @if($cat->templates != "[]")
                <li class="nav-item  p-1">
                            <a class="nav-link" data-bs-toggle="collapse" href="#{{$cat->slug}}" role="button"
                                aria-expanded="false" aria-controls="{{$cat->slug}}">
                                <i class="link-icon"><img src="{{$url_aws}}category/{{$cat->icon}}" style="max-width:20px; max-height:20px;"></i>
                                <span class="link-title">{{$cat->name}}</span>
                                <i class="link-arrow" data-feather="chevron-down"></i>
                            </a>
                            <div class="collapse" id="{{$cat->slug}}">
                                <ul class="nav sub-menu">
                                  
                                    @foreach ($cat->templates as $tooler)
                                        <li class="nav-item  p-1">

                                            <a class="nav-link " @if($get_user_details->plan_id != 5)  href="{{route('ai', $tooler->slug)}}"   @else @if($tooler->premium==1 && $get_user_details->plan_id != 5) href="{{route('ai', $tooler->slug)}}" @elseif($tooler->premium==0 && $get_user_details->plan_id == 5) href="{{ route('ai', $tooler->slug) }}" @else data-bs-toggle="modal" data-bs-target="#upgradeplan"  @endif @endif>
                                                {{ $tooler->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li> 
                        @endif
               @endforeach


            


        </ul>
    </div>
</nav>


