@extends('userweb.layout.app')

@section('content')
<?php
use App\Models\Folder;
use App\Models\User;
use App\Models\SubMembership;
use App\Models\Project;

$btncolor=\App\Models\Setting::where('name','btncolor')->first()->value;
$get_user_details=User::where('id',auth()->user()->id)->first();
$get_user_plan_details=SubMembership::with('mem')->where('id',$get_user_details->plan_id)->first();
?>

    <style>
        .act-card:hover {
            /* box-shadow: 1px 1px 6px 1px grey; */
        }

        .folder:hover {
            color: white !important;
        }

        .btn:hover {
            /* color: #fff !important; */
            text-decoration: none;
        }

        .imgzoom {
            /* padding: 50px; */
            transition: transform .1s;
            margin: 0 auto;
        }

        h2 {
            color: {{$btncolor}} !important;
            font-size: 18px;

        }

        .navbar .navbar-brand {
            width: auto;
            flex: 1 1;
            display: flex;
            align-items: center;
        }

        .badge {
            color: #fff;
            background: {{$btncolor}} !important;
            font-weight: 500;
            padding: 0 8px;
            height: 24px;
            line-height: 24px;
            font-size: 14px;
            margin-right: 20px;
            font-family: "Plus Jakarta";
        }

        .new {
            background-color: #EEEDFA;
            border-radius: 12px;
            padding: 25px 30px;
            background-size: 90%;
            background-repeat: no-repeat;
            background-position: right top;
        }

        .flex {
            display: flex;
        }

        .tools-area .model-box {
            transition: all .2s ease-in-out;
        }

        .model-box a {
            color: #718096;
            text-decoration: none;
            display: block;
            padding: 20px 20px 5px;
            background: #fff;
            width: 100%;
            height: 100%;
            position: relative;
        }



        .tools-area {
            margin-top: 30px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 20px;
        }

        @media screen and (max-width: 100px) {
            .tools-area {
                margin-top: 30px;
                display: grid;
                /* grid-template-columns: 1fr 1fr 1fr 1fr; */
                gap: 20px;
            }
        }


        .card:hover {
            transform: scale(1.1);
        }

        .ic {

            padding: 9px;
        }


        .cardcheckbox {
            opacity: 1;
            width: 20px;
            height: 20px;

        }

        .dashboard h1.new-user-no-content {
            border-bottom: 1px solid #e3e7ef;
            padding-bottom: 20px;
        }

        .act-card:hover,
        .cardcheckbox:checked {
            opacity: 1;
        }

        .dashboard h1 {
            text-align: center;
            color: #141125;
            font-size: 20px;
            display: flex;
            align-items: center;
            margin-top: 10px;
        }



        a {
            color: inherit !important;
        }


        .flex {
            display: flex;
        }

        .space-between {
            justify-content: space-between;
        }

        h1.nd,
        h2.nd {
            color: #141125;
            font-weight: 700;
            font-size: 30px;
            line-height: 38px;
            margin-bottom: 3px;
            letter-spacing: -0.02em;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

     

        svg {
            overflow: hidden;
            vertical-align: middle;
        }


        .content-layout-options .btn.active {
            color: {{$btncolor}};
            background: rgba(255, 255, 255, .5);
            border: 1px solid rgb(203, 213, 224, .5);
        }

        

        

        .content-layout-options {
            color: #667085;
            font-size: 13px;
            display: flex;
            align-items: center;
        }

        .doc-icon {
            padding: 13px 0 13px 10px;
        }

        .doc-icon svg {
            width: 26px;
        }

        svg {
            overflow: hidden;
            vertical-align: middle;
        }

        .content-menu>button {
            background: #fff;
            color: #141125;
            width: 32px;
            height: 32px;
            padding: 0;
            max-height: 32px;
            min-height: 32px;
            line-height: 24px;
            border-radius: 4px;
            border: 1px solid #EAECF0 !important;
        }

        .my-content-grid .card .c-details {
            padding: 12px 15px 12px 10px;
            font-size: 12px;
            color: #667085;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        #my-content .icons-row {
            white-space: nowrap;
            overflow-x: scroll;
            width: 100%;
            margin-bottom: 25px !important;
            align-items: center;
            -ms-overflow-style: none;
            scrollbar-width: none;
            padding-bottom: 0px;
        }

        .new-design .icon-big.active {
            border-bottom: 2px solid #1E109A;
            color: #141125 !important;
        }

        #my-content .icons-row .icon-big {
            display: inline-block;
            line-height: 32px;
            padding: 0 16px;
        }

        .new-design .icon-big {
            background: none;
            border-radius: 0;
            border: none;
            color: #667085 !important;
            padding: 0 7px !important;
            border-bottom: 2px solid transparent;
            margin-right: 15px;
        }

        .sub-nd {
            color: #667085;
            font-size: 15px;
            font-weight: 500;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            letter-spacing: -0.01em;
            margin-bottom: 20px;
        }

        .article-thumb {
            width:70%;
            justify-content: center;
            align-items: center;
            align-content: center;
            margin: 0 auto;
            font-size: 11px;
            color: #667085;
            padding: 10px 12px;
            background: #fff;
        }

        .flex {
            display: flex;
        }

        .doc-thumbnail {
            height: 150px;
            overflow: hidden;
            background-size: cover;
            border-radius: 5px 5px 0 0;
            background-position: center center;
            background-color: #EDF2F6;
            display: flex;
            border-bottom: 1px solid #EAECF0;
            position: relative;
        }

        .my-content-grid {
            display: -ms-grid;
            display: grid;
            -webkit-box-pack: start;
            -ms-flex-pack: start;
            justify-content: start;
            grid-template-columns: repeat(auto-fill, 23.5%);
            -webkit-column-gap: 1.68rem;
            column-gap: 2%;
            row-gap: 15px;
            margin: 1.5rem 0 2rem;
        }
        
        @media only screen and (max-width: 700px) {
            .tools-area {
                margin-top: 30px;
                display: flex;
                flex-direction: column;
                /* grid-template-columns: 1fr 1fr 1fr 1fr; */
                gap: 20px;
       }
}
        
        @media only screen and (max-width: 700px) {
            .my-content-grid {
                display: block;
                -webkit-box-pack: start;
                -ms-flex-pack: start;
                justify-content: start;
                grid-template-columns: repeat(auto-fill, 23.5%);
                -webkit-column-gap: 1.68rem;
                column-gap: 2%;
                row-gap: 15px;
                margin: 1.5rem 0 2rem;
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
    <div class="container">
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
        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow-1">
                    <div class="row">
                        <h1 class="new-user-no-content mb-3"><span style="margin-right: 9px;">👋🏻</span> Hey {{auth()->user()->name}} <span
                                style="color: #667085;font-size: 26px;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing:grayscale;margin-left:10px;margin-top:2px;letter-spacing:-0.04em"><span
                                    class="hide-mobile">—</span>Let's bring your ideas to life!</span></h1>
                        <hr class="dashboard">
                        @php($name = \App\Models\Setting::where('name', 'app_name')->first()->value)
                        @php($words_generated1 = \App\Models\History::where('user_id', auth()->user()->id)->sum('prompt_tokens'))
						@php($words_generated2 = \App\Models\History::where('user_id', auth()->user()->id)->sum('response_tokens'))
						@php($words_generated3 = \App\Models\Chat::where('user_id', auth()->user()->id)->sum('tokens'))
                        @php($items_generated = \App\Models\History::where('user_id', auth()->user()->id)->count())
                        @php($getpopular=\App\Models\Template::where('popular',1)->get())
                        @php($gethighlight=\App\Models\Template::where('highlighted',1)->get())
                        <?php $time_saved = \App\Models\History::where('user_id', auth()->user()->id)->count() * 15;
                        if($time_saved < 60){
							$time_saved2=$time_saved." mins";
						}else{
                        $time_saveda = $time_saved / 60;
						$time_saved2=$time_saveda." hrs";
						}
						
						$words_generated=$words_generated1+$words_generated2+$words_generated3;
                        $tools = \App\Models\History::where('user_id', auth()->user()->id)
                            ->get();

                         $typess = $tools->unique('tools');
                         $usedtools=count($typess);
                        $totaltools = \App\Models\Template::count();
                        
                        ?>

                        <div class="col-md-3 col-xl-3 col-sm-12 col-xs-12 col-lg-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <h6 class="text-secondary">Words Generated <span class="text-secondary"></span></h6>

                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-12 col-xl-5">
                                             <?php
                                             $precision=1;
                                              $n=$words_generated;
                                               if ($n < 900) {
                                                // 0 - 900
                                                $n_format = number_format($n, $precision);
                                                $suffix = '';
                                            } else if ($n < 900000) {
                                                // 0.9k-850k
                                                $n_format = number_format($n / 1000, $precision);
                                                $suffix = 'K';
                                            } else if ($n < 900000000) {
                                                // 0.9m-850m
                                                $n_format = number_format($n / 1000000, $precision);
                                                $suffix = 'M';
                                            } else if ($n < 900000000000) {
                                                // 0.9b-850b
                                                $n_format = number_format($n / 1000000000, $precision);
                                                $suffix = 'B';
                                            } else {
                                                // 0.9t+
                                                $n_format = number_format($n / 1000000000000, $precision);
                                                $suffix = 'T';
                                            }
                                          
                                            if ( $precision > 0 ) {
                                                $dotzero = '.' . str_repeat( '0', $precision );
                                                $n_format = str_replace( $dotzero, '', $n_format );
                                            }
                                          $numberr=$n_format . $suffix;
                                          ?>
                                            <h3 class="mb-2" style="clear: both;display: inline-block;overflow: hidden;white-space: nowrap;">{{ $numberr }}</h3>
                                            <div class="d-flex align-items-baseline">

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 col-sm-12 col-xs-12 col-lg-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <h6 class="text-secondary">Items Generated <span class="text-secondary"></span></h6>

                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-12 col-xl-5">
                                            <h3 class="mb-2" style="clear: both;display: inline-block;overflow: hidden;white-space: nowrap;">{{ $items_generated }}</h3>
                                            <div class="d-flex align-items-baseline">

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xl-3 col-sm-12 col-xs-12 col-lg-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <h6 class="text-secondary">Time Saved <span class="text-secondary"></span></h6>

                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-12 col-xl-5">
                                            <h3 class="mb-2" style="clear: both;display: inline-block;overflow: hidden;white-space: nowrap;">{{ $time_saved2 }}</h3>
                                            <div class="d-flex align-items-baseline">

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xl-3 col-sm-12 col-xs-12 col-lg-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <h6 class="text-secondary">Tools Used <span class="text-secondary"></span></h6>

                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-12 col-xl-5">
                                            <h3 class="mb-2" style="clear: both;display: inline-block;overflow: hidden;white-space: nowrap;">{{ $usedtools }}/{{ $totaltools }}</h3>
                                            <div class="d-flex align-items-baseline">

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <h3 class="mb-3 mb-md-0"><span>Most Popular
                                    Tools</span></h3>
                            <p style="color: grey">These are the most popular tools and a good place to start. Give them a
                                try!</p>
                        </div>
                        <div class="col-6">
                            <div style="float:right !important"> <a href="{{route('all_toolss')}}"
                                    class="btn white shadow-sm">See More
                                    Templates
                                    <svg width="14" height="14" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M1.1665 7.00002h11.6667m0 0L6.99984 1.16669m5.83336 5.83333L6.99984 12.8334"
                                            stroke="currentColor" stroke-width="1.66667" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg></a>
                            </div>
                        </div>
                    </div>

                   
                    @foreach ($getpopular as $tool)
                        <div class="col-md-3 col-xl-3 col-sm-12 col-xs-12 col-lg-3 grid-margin">
                            <div class="card " @if($tool->premium==1) style="font-size: 18px;margin-top: 12px;border:1px solid yellow;background:#ffda973b" @else style="font-size: 18px;margin-top: 12px;"  @endif>
                                <a  @if($get_user_details->plan_id != 5)  href="{{route('ai', $tool->slug)}}"   @else @if($tool->premium==1 && $get_user_details->plan_id != 5) href="{{ route('ai', $tool->slug) }}" @elseif($tool->premium==0 && $get_user_details->plan_id == 5) href="{{ route('ai', $tool->slug) }}" @else data-bs-toggle="modal" data-bs-target="#upgradeplan"  @endif @endif>
                                     @if($tool->premium==1)<img src="{{url('user_assets/images/pro.png')}}" style="float:right;margin: 4px; max-width:20px; max-height:20px;" alt="pro"> @endif
                                    <div class="card-body">

                                        <div class="ic"><img
                                                src="{{ $url_aws }}icon/{{ $tool->icon }}"
                                                style="width:40px;height:40px;margin-top: 3px;"></div>
                                        <h5 style="margin-top:10px !important;">
                                            {{ $tool->name }}
                                        </h5>
                                        <p class="mt-2" style="font-size: 75%; color: grey">
                                            {{ Str::limit($tool->description, 30) }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div> <!-- row -->

        <div class="dash-section new">
            <div class="dash-header">
                <div class="flex">
                    <div class="badge">New</div>
                    <h2>Check out these new tools {{ $name }} has to offer!</h2>
                </div>
            </div>
            <div class="tools-area">
               
                @foreach($gethighlight as $tool)
                    <div class="model-box item card" data-category="blogcontent" data-model="smart-editor" @if($tool->premium==1) style="border:1px solid yellow;background:#ffda973b" @endif>
                        <a  @if($get_user_details->plan_id != 5)  href="{{route('ai', $tool->slug)}}"   @else @if($tool->premium==1 && $get_user_details->plan_id != 5) href="{{ route('ai', $tool->slug) }}" @elseif($tool->premium==0 && $get_user_details->plan_id == 5) href="{{ route('ai', $tool->slug) }}" @else data-bs-toggle="modal" data-bs-target="#upgradeplan"  @endif @endif>
                             @if($tool->premium==1)<img src="{{url('user_assets/images/pro.png')}}" style="float:right;margin: 4px; max-width:20px; max-height:20px;" alt="pro"> @endif
                            <div class="ic"><img src="{{ $url_aws }}icon/{{ $tool->icon }}"
                                    style="width:40px;height:40px;margin-top: 3px;"></div>
                            <h4 class="mt-2">{{ $tool->name }}</h4>
                            <p class="mt-2 mb-2"> {{ Str::limit($tool->description, 30) }}
                            </p>
                            <i class="mdi mdi-arrow-top-right"></i>
                        </a>
                    </div>
                @endforeach



            </div>
        </div>
        <br>
        <hr>
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div class="col-6">
                <h4 class="mb-3 mb-md-0 "><span class="border-bottom">Folders</span></h4>
            </div>
            <div class="col-6">

                   @php($folder = \App\Models\Folder::where('user_id', auth()->user()->id)->get())
                   @if($get_user_plan_details->mem->folder_limit != 0)
                        @if(count($folder) < $get_user_plan_details->mem->folder_limit)
                <div style="float:right !important"><button type="button" class="btn btn-outline-primary"
                        data-bs-toggle="modal" data-bs-target="#folder">
                        Add Folder
                    </button> </div>
                    @endif
                    @else
                    <div style="float:right !important"><button type="button" class="btn btn-outline-primary"
                        data-bs-toggle="modal" data-bs-target="#folder">
                        Add Folder
                    </button> </div>
                    @endif
            </div>
            <!-- Modal -->
            <div class="modal fade" id="folder" tabindex="-1" aria-labelledby="folderLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="folderLabel">Folder Name</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="btn-close"></button>
                        </div>
                        <form action="{{ route('create_folder') }}" method="post">
                            @csrf
                            <div class="modal-body">

                                <div class="form-group">
                                    <label id="folderLabel">Folder Name</label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Enter Folder Name">
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Create Folder</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow-1">

                    <div class="d-flex">

                      <?php
                       $user = User::select('id')->where('user_id',auth()->user()->id)->get();
                        $id[]= auth()->user()->id;
                        foreach($user as $usr){
                            $id[] = $usr->id;
                        }
                        $folder= Folder::whereIn('user_id', $id)->get();
                       ?>
                        @if (count($folder) > 0)
                            @foreach ($folder as $foll)
                                <a href="{{ route('folder_project') }}?folder_id={{ $foll->id }}">

                                    <div class="btn btn-outline-primary folder mr-3 text-black"
                                        style="margin-right: 4px;border:none">

                                        <center><img src="{{ url('user_assets/images/folder.png') }}" alt="img"
                                                style="width:80px">
                                            <p> <b style="color:black">{{ $foll->name }}</b> &nbsp; &nbsp;</p>
                                        </center>

                                    </div>
                                </a>
                            @endforeach
                        @else
                            <center>No folder Avaiable</center>
                        @endif
                    </div>

                </div>
            </div>
        </div> <!-- row -->
        <br><br>
        <form action="{{ route('move_project_to_folder') }}" method="post">
            @csrf
            <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                <div class="col-6">
                    <h4 class="mb-3 mb-md-0"><span class="border-bottom">Projects</span></h4>
                </div>

                <div class="col-6" id="text" style="display:none">



                    <div style="float:right !important"><button type="button" class="btn btn-outline-primary"
                            data-bs-toggle="modal" data-bs-target="#projecttofolder">
                            Move to folder
                        </button> </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="projecttofolder" tabindex="-1" aria-labelledby="projecttofolderLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="projecttofolderLabel">Projects to Folder</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="btn-close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="form-group">
                                    <label id="folderLabel">Select Folder</label>

                                    <select name="folders" class="form-control" required>
                                        @php($folder = \App\Models\Folder::where('user_id', auth()->user()->id)->get())
                                        <option disabled selected>Select Folder</option>
                                        @foreach ($folder as $foll)
                                            <option value="{{ $foll->id }}">{{ $foll->name }}</option>
                                        @endforeach
                                    </select>

                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Move Projects</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12 col-xl-12 stretch-card">
                    <div class="row flex-grow-1">

                        <div class="my-content-grid">
                            @php($folder = Project::whereIn('user_id', $id)->orderBy('id','Desc')->get())

                            @if(count($folder) > 0)
                                @foreach ($folder as $projec)
                                    <div class="card" data-category="smart-editor" style="">
                                        <div class="card-header">
                                            <div class="card-title"><input type="checkbox" class="cardcheckbox"
                                                    align="right" id="myCheck{{ $projec->id }}"
                                                    onclick="myFunction{{ $projec->id }}()" name="projects[]"
                                                    value="{{ $projec->id }}" /></div>
                                        </div>
                                        <a @if($projec->image == NULL)  href="{{ route('edit_project') }}?project={{ $projec->id }}" target="_blank" @else  href="{{url('storage/app/public/images')}}/{{$projec->image}}" download="{{ $projec->project_id }}" @endif>
                                            <div class="doc-thumbnail">
                                                <div class="article-thumb">@if($projec->image != NULL)<center> <img src="{{$url_aws}}images/{{$projec->image}}" style="width: 100%;">  </center>@else {!! $projec->project_text !!}@endif</div>
                                            </div>
                                            <div class="flex">
                                                <div class="doc-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                                                        <path
                                                            d="M6 0h20c3.314 0 6 2.686 6 6v20c0 3.314-2.686 6-6 6H6c-3.314 0-6-2.686-6-6V6c0-3.314 2.686-6 6-6z"
                                                            fill="#E6FCF4"></path>
                                                        <path
                                                            d="M20 8h-8c-1.103 0-2 .897-2 2v10c0 .177.07.346.195.471l3.333 3.333c.126.126.295.196.472.196h6c1.103 0 2-.897 2-2V10c0-1.103-.897-2-2-2zm.667 14c0 .368-.299.667-.667.667h-5.333v-1.5c0-1.011-.822-1.833-1.833-1.833h-1.5V10c0-.368.299-.667.667-.667h8c.368 0 .667.299.667.667v12z"
                                                            fill="#16B885"></path>
                                                        <path
                                                            d="M18.167 13.333h-4.333c-.643 0-1.167-.523-1.167-1.167v-.333c0-.643.523-1.167 1.167-1.167h4.333c.643 0 1.167.523 1.167 1.167v.333c-.001.644-.524 1.167-1.167 1.167zm.5 2.667h-5.333c-.368 0-.667-.299-.667-.667s.299-.667.667-.667h5.333c.368 0 .667.299.667.667s-.299.667-.667.667zm0 2.667h-5.333c-.368 0-.667-.299-.667-.667s.299-.667.667-.667h5.333c.368 0 .667.299.667.667s-.299.667-.667.667z"
                                                            fill="#66dc9f"></path>
                                                    </svg>
                                                </div>
                                                <div class="d-flex c-details w-100">
                                                    <div class="w-100">
                                                    <strong>{{ $projec->project_id }}</strong><br>
                                                    <span>{{ date('d-M-Y', strtotime($projec->created_at)) }}</span>
                                                       
                                                </div>
                                                @if($projec->image != NULL)
                                                <div class="w-100">

                                                 <a style="float:right !important;" href="{{url('storage/app/public/images')}}/{{$projec->image}}" download="{{ $projec->project_id }}">
                                                         <i class="link-icon" data-feather="download"></i></a>
                                                </div>@endif </div>
                                            </div>
                                        </a>
                                    </div>

                                    <script>
                                        function myFunction{{ $projec->id }}() {
                                            var checkBox = document.getElementById("myCheck{{ $projec->id }}");
                                            var text = document.getElementById("text");
                                            if (checkBox.checked == true) {
                                                text.style.display = "block";
                                            } else {
                                                text.style.display = "none";
                                            }
                                        }
                                    </script>
                                @endforeach
                        </div>
                    @else
                        <div class="col-md-12 col-xl-12 col-sm-12 col-xs-12 col-lg-12 grid-margin stretch-card">
                            <div class="card" style="font-size: 18px;margin-top: 12px;">
                                <a href="{{route('all_toolss')}}">
                                    <div class="card-body">

                                        <center style="margin-top:26px !important; color:black;"><img
                                                src="{{ url('user_assets/images/noprojects.png') }}"> <br>+<br>
                                            Create New Project
                                        </center>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>

                </div>
            </div> <!-- row -->
        </form>
    </div>



@endsection
@push('scripts')

@endpush





