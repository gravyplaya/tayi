@extends('userweb.layout.app')
@php($get_user_details=\App\Models\User::where('id',auth()->user()->id)->first())
@php($get_user_plan_details=\App\Models\SubMembership::with('mem')->where('id',$get_user_details->plan_id)->first())
@section('content')

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
        .row {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -9px;
            margin-left: -9px;
        }

        .new-search h1 {
            margin-bottom: 0;
        }

        .dashboard-search {
            flex: 1;
            display: flex;
            justify-content: end;
            position: relative;
            align-items: center;
        }

        .dashboard-search .tool-request {
            color: #667085;
            font-size: 14px;
            font-weight: 500;
            margin-right: 10px;
            display: flex;
            flex-direction: row;
            align-items: center;
            height: 40px;
            max-height: 40px;
            min-height: 40px;
            background: #fff;
            border: 1px solid #e4e2ed;
            padding: 0 10px;
            transition: all 0.3s ease;
        }

        .new-search {
            align-items: initial;
            margin-bottom: 20px;
        }

        .new-design .icon-big.active {
            border-bottom: 2px solid #1E109A;
            color: #141125 !important;
        }

        .space-between {
            justify-content: space-between;
        }

        .flex {
            display: flex;
        }

        .new-search #main-tool-search {
            border-radius: 6px !important;
            height: 40px;
            max-width: 300px;
        }

        #main-tool-search.full {
            width: 100%;
        }

        .ic {
            width: 32px;
            height: 32px;
        }

        .card:hover {
            transform: scale(1.1);
        }

        #main-tool-search {
            height: 36px;
            background: #fff;
            border: 1px solid #e4e2ed;
            border-radius: 18px;
            font-weight: 500;
            padding: 0 16px;
            font-size: 14px;
            width: 40px;
            transition: all 0.3s ease;
        }

        .mdi-magnify:before {
            content: "\F349";
        }


        .mdi:before,
        .mdi-set {
            display: inline-block;
            /* font: normal normal normal 24px/1 "Material Design Icons"; */
            font-size: inherit;
            text-rendering: auto;
            line-height: inherit;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .new-search .reveal-search-input {
            color: #667085;
        }

        button:not(:disabled),
        [type="button"]:not(:disabled),
        [type="reset"]:not(:disabled),
        [type="submit"]:not(:disabled) {
            cursor: pointer;
        }

        .reveal-search-input {
            background: transparent;
            position: absolute;
            height: 36px;
            font-size: 20px;
            line-height: 36px;
            width: 39px;
            color: #000;
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

        button.icon-big,
        a.icon-big {
            display: flex;
            justify-content: center;
            flex-direction: row;
            align-items: center;
            margin: 0 8px 0 0;
            position: relative;
            /* background: #fff; */
            font-size: 14px;
            padding: 0 12px 0 16px;
            border-radius: 18px;
            font-weight: 500;
            height: 36px;
            border: 1px solid #e4e2ed;
            color: #000;
            transition: all 0.3s ease;
        }

        button {
            border: none;
        }

        .shadow-sm {
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 5%);
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <div class="container">

        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow-1">
                    <div class="row">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Search
        </h2>
    </x-slot>

    <div>
        <div class="row" id="">
            <div class="col-md-12 grid-margin dashboard" style="margin-top:10px">
                <div class="flex space-between new-search">
                    <h1 style="text-align: left;font-size: 30px;">All Tools</h1>
                    
                </div>
                <div class="grid-margin" id="what-will-you">
                    <div class="icons-row new-design">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="icon-big active" data-category="all"><a href="#all" class="icon-big "
                                    aria-controls="all" role="tab" data-toggle="tab">All</a></li>
                            @php($category=\App\Models\Category::with('templates')->get())
                           @foreach($category as $cat)
                           @if($cat->templates != "[]")
                            <li class="icon-big" data-category="alltools{{$cat->id}}"><a href="#alltools{{$cat->id}}" class="icon-big "
                                    aria-controls="alltools{{$cat->id}}" role="tab" data-toggle="tab">{{$cat->name}}</a></li>
                           @endif
						   @endforeach
                           
                        </ul>

                        <!-- Tab panes -->
                        <div class="tools-area">
                            <div class="model-box item" data-category="blogcontent" data-model="article-generator">
                                <div class="tab-content">
									  <div role="tabpanel" class="tab-pane active" id="all" style="background: none">
                                        <div class="row">
                                               @php($tools = \App\Models\Template::get())
                                                @foreach ($tools as $tool)
                                                <div class="col-md-3 col-xl-3 col-sm-12 col-xs-12 col-lg-3 grid-margin" style="float:left !important">
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
                                   @foreach($category as $cat)
									 @if($cat->templates != "[]")
                                    <div role="tabpanel" class="tab-pane" id="alltools{{$cat->id}}" style="background: none">
                                        <div class="row">
                                                 
                                                @foreach ($cat->templates as $tool)
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
									@endif
                                    @endforeach
									
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
        </div>
    </div>
    <script>
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            
        });
        //get last active tab from local storage
        var lastTab = "#all"; // localStorage.getItem('lastActiveTab');
        console.log(lastTab + "tab was last active")
        if (lastTab) {
            $('[href="' + lastTab + '"]').tab('show');
        }
    </script>
@endsection
