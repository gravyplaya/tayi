
@extends('userweb.layout.app')

@section('content')
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
        .flex {
            display: flex;
        }

        .space-between {
            justify-content: space-between;
        }

       


        svg {
            overflow: hidden;
            vertical-align: middle;
        }


        .content-layout-options .btn.active {
            color: #1E109A;
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
            font-size: 12px !important;
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
            width: 70%;
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
 

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Search
        </h2>
    </x-slot>

    <div>
        <div class="container" id="">
            <div class="col-md-12 grid-margin dashboard" style="margin-top:10px">
                <div class="flex space-between new-search">
                    <h1 style="text-align: left;font-size: 30px;">My Content</h1>
                    
                </div>
                <div class="grid-margin" id="what-will-you">
                    <div class="icons-row new-design">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="icon-big active" data-category="all"><a href="#all" class="icon-big "
                                    aria-controls="all" role="tab" data-toggle="tab">All</a></li>
                         @php($folders =\App\Models\Template::with('projects')->get())


 
              @foreach($folders as $folder)
                   @php($projects =\App\Models\Project::with('templatedet','related_folder')->where('user_id',auth()->user()->id)->where('template',$folder->id)->get())
                    @if(count($projects)>0)
                            <li class="icon-big" data-category="tabss{{$folder->id}}"><a href="#tabss{{$folder->id}}" class="icon-big "
                                    aria-controls="tabss{{$folder->id}}" role="tab" data-toggle="tab">{{$folder->name}}</a></li>

                     @endif
                @endforeach

                           
                        </ul>
                        <!-- Tab panes -->
                  
                                <div class="tab-content">
                                  
                                    <div role="tabpanel" class="tab-pane active" id="all" style="background: none">
                                        <div class="row">
                                            @php($projects =\App\Models\Project::with('templatedet','related_folder')->where('user_id',auth()->user()->id)->get())
                                              @foreach($projects as $projec)
                                                <div class="col-md-3 col-xl-3 col-sm-12 col-xs-12 col-lg-3 grid-margin">
                                                    <div class="card ">

                                                        <a @if($projec->image == NULL)  href="{{ route('edit_project') }}?project={{ $projec->id }}" target="_blank" @else  href="{{url('storage/app/public/images')}}/{{$projec->image}}" download="{{ $projec->project_id }}" @endif>
                                                            <div class="doc-thumbnail">
                                                                <div class="article-thumb">@if($projec->image != NULL) <img src="{{$url_aws}}images/{{$projec->image}}" style="width: 100%;"> @endif
                                                                    {!! $projec->project_text !!}</div>
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
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                  @foreach($folders as $folder)

                                    <div role="tabpanel" class="tab-pane" id="tabss{{$folder->id}}" style="background: none">
                                        <div class="row">
                                                 <?php
                                            $user = \App\Models\User::select('id')->where('user_id',auth()->user()->id)->get();
                                            $id[]= auth()->user()->id;
                                            foreach($user as $usr){
                                                $id[] = $usr->id;
                                            }
                                            $projects =\App\Models\Project::with('templatedet','related_folder')->whereIn('user_id',$id)->get()
                                  ?>
                                                   @foreach($projects as $projec)
                                                <div class="col-md-3 col-xl-3 col-sm-12 col-xs-12 col-lg-3 grid-margin">
                                                    <div class="card ">

                                                        <a @if($projec->image == NULL)  href="{{ route('edit_project') }}?project={{ $projec->id }}" target="_blank" @else  href="{{url('storage/app/public/images')}}/{{$projec->image}}" download="{{ $projec->project_id }}" @endif>
                                                            <div class="doc-thumbnail">
                                                                <div class="article-thumb">@if($projec->image != NULL) <center><img src="{{url('storage/app/public/images')}}/{{$projec->image}}" ></center> @endif
                                                                    {{$projec->project_text}}</div>
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
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                     @endforeach

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






