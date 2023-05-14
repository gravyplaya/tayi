@extends('userweb.layout.app')
@php($get_user_details=\App\Models\User::where('id',auth()->user()->id)->first())
@php($get_user_plan_details=\App\Models\SubMembership::with('mem')->where('id',$get_user_details->plan_id)->first())
@php($remaining_words = $get_user_details->tokens - $get_user_details->token_reached);
@section('content')
@php($get_user_details=\App\Models\User::where('id',auth()->user()->id)->first())
@php($get_user_plan_details=\App\Models\SubMembership::with('mem')->where('id',$get_user_details->plan_id)->first())
<style>
.settings-sidebar .sidebar-body .settings-sidebar-toggler {
    left: -68px;
    padding: 8px;
} </style>



    <style>
        .navbar{
            margin-top: -22px !important;
        }

        .card {
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 10%), 0 1px 2px 0 rgb(0 0 0 / 6%);
            border-radius: 6px;
        }

        .card .card-title .logo {
            display: block;
            height: 22px;
            margin-right: 10px;
            width: 22px;
        }

        .btn-circle.btn-lg {
            width: 50px;
            height: 50px;
            padding: 10px 12px;
            font-size: 18px;
            line-height: 1.33;
            border-radius: 25px;
            background-color: #2e16e6;
        }

        .card .card-body {
            padding: 20px 25px;
        }

        .ideacontent {
            box-shadow: inset 0 2px 4px 0 rgb(0 0 0 / 6%);
            background: #edf2f7;
            border-radius: 0 0 6px 6px;
            overflow-y: auto !important;
        }

        .card-body {
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.25rem;
        }

        .tip p {
            color: #7b8aa5;
            font-size: 13px;
            padding: 0 0 0 5px;
            margin-bottom: 0;
        }

        .fields .field.half {
            width: 48.5%;
        }

        .ideabar {
            border-top: 1px solid rgb(226, 232, 240);
            border-left: 1px solid rgb(226, 232, 240);
            border-right: 1px solid rgb(226, 232, 240);
            border-radius: 6px 6px 0 0;
            padding: 8px;
        }

        .items-center {
            align-items: center;
        }

        .justify-between {
            justify-content: space-between;
        }

        .flex {
            display: flex;
        }

        .ideabuttons>div.active {
            background: #F0EDFB;
            border-radius: 50px;
            padding-left: 14px;
            padding-right: 14px;
            font-weight: 500;
            color: #2e16e6;
            line-height: 26px;
        }

        .white:hover {
            background: #F7FAFC;
            color: rgba(113, 128, 150);
        }

        .ideabar .btn {
            font-size: 13px;
        }

        .big-icon svg {
            width: 42px;
            border-radius: 8px;
            box-shadow: 0px 2px 5px 0 rgb(0 0 0 / 10%);
        }

        svg {
            overflow: hidden;
            vertical-align: middle;
        }

        .height-align .explainer,
        .favs .explainer {
            margin-bottom: 70px;
            margin-top: 20px;
        }

        .text-gray {
            color: #7b8aa5;
        }

        p {
            font-size: 0.875rem;
            line-height: 1.5;
        }

        .ideacontent h2 {
            color: #4a5568;
            font-weight: 600;
            font-size: 21px;
        }

        .ideacontent p.description {
            width: 90%;
            margin: 0 auto 15px;
            color: #4a5568;
        }


        .ideabuttons>div {
            margin-left: 14px;
            line-height: 25px;
        }

        .outputs_cnt {
            position: relative;
            margin-right: 9px;
            width: 86px;
            padding-right: 0;
        }

        .select-wrapper {
            position: relative;
            background: #edf2f7;
            border-radius: 4px;
        }

        .card input,
        .card select,
        .card textarea {
            background: #edf2f7;
            color: #000;
            padding: 8px;
            border-radius: 4px;
            font-size: 14px;
            width: 100%;
            border: 1px solid rgba(226, 232, 240);
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 5%);
        }

        .card select {
            height: 40px;
            width: 100%;
            padding: 7px 13px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }


        .submit-form .btn,
        .save-download-form .btn {
            min-height: 25px;
            height: 45px;
            line-height: 1;
            border: none;
            width: 100%;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 10%), 0 1px 2px 0 rgb(0 0 0 / 6%);
            font-family: "Plus Jakarta";
            font-weight: 600;
            font-size: 15px;
            background: #2e16e6;
            position: relative;
        }

        #aifields .submit-form {
            margin-top: 10px;
        }

        .model_page .submit-form:not(.text-center) {
            display: flex;
        }

        .outputs_cnt i {
            background: transparent;
            color: #A0AEC6;
            position: absolute;
            height: 24px;
            width: 24px;
            display: block;
            text-align: center;
            line-height: 22px;
            transition: all 0.3s ease;
            font-size: 17px;
        }

        .outputs_cnt i.down {
            right: 0;
            bottom: 0;
        }



        .select2-selection--single {
            padding: 0 0px 0 10px !important;
        }

        .card .card-title {
            margin-bottom: 8px;
            align-items: center;
        }

        .card-title {
            margin-bottom: 0;
            display: flex;
            line-height: 1;
        }

        .card label {
            color: #4a5568;
            font-weight: 500;
            font-size: 14px;
            display: block;
            line-height: 20px;
            margin-bottom: 6px;
        }

        .card textarea {
            background: #edf2f7;
            color: #000;
            padding: 8px;
            border-radius: 4px;
            font-size: 14px;
            width: 100%;
            border: 1px solid rgba(226, 232, 240);
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 5%);
        }

        .field_row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .textarea {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .flex {
            display: flex;
        }

        .justify-between {
            justify-content: space-between;
        }

        .text-gray {
            color: #7b8aa5;
        }

        .card .card-body {
            padding: 20px 25px;
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
  <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Search
        </h2>
    </x-slot>
 
    <div>
    <div class="container">

        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div>
                   
                    <?php 

                   if($getproject->template ==NULL){
                        $id= 1;
                      }else{
                         $id= $getproject->template;
                      }
                    ?>

   @php($get_details=\App\Models\Template::where('id',$id)->first())
       
        <div class="row model_page" id="blog-titles-listicles">
            <div class="col-md-4 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="logo"><img
                                                src="{{$url_aws}}icon/{{ $get_details->icon }}"
                                                style="width:30px;height:30px;margin-top: 3px;"></div>&nbsp; &nbsp;
                              
                            <h4 style="line-height:24px;">{{$get_details->name}}</h4>
                        </div>
                       
                        <p class="text-gray text-sm">Automatically generate {{$get_details->name}}.</p>
                         <form class="row g-3 needs-validation" id="newform">
                             @csrf
                            <div class="fields">
                               
                              <input type="hidden" name="ex_id" value="{{$id}}">

                              @foreach($get_details->template_fields as $template)
                           <div class="field_row mt-2">
                                     
                              <div class="field full mt-3 w-100">
                                    <div class="flex items-center content-center justify-between">
                                        <label for="topic">{{$template['field_name']}}<span style="color:red">*</span></label>
                                        
                                    </div>
                                  @if($template['field_type'] == "textarea")  
                                    <textarea name="{{$template['name']}}" maxlength="1000" id="title"
                                        placeholder="{{$template['description']}}" rows="5"
                                        required="required"></textarea>
                                    @else
                                    <input type="text" name="{{$template['name']}}" class="form-control"  placeholder="{{$template['description']}}" required>
                                    @endif
                                </div>
                                </div>
                                @endforeach
                                
                                


                                @if($get_details->tone==1 )
                              
                                 <div class="field full mt-3 w-100">
                                   <div class="field full w-100">
                                            <label for="validationCustom01" class="form-label">Tone <span style="color:grey">(optional)</span></label>
                                              <select name="tone" class="form-control" id="tone">
											   <option disabled selected>Select a tone</option>
                                               <option value="friendly">😊 Friendly</option>
                                               <option value="luxury">💎 Luxury</option>
                                               <option value="relaxed">😌 Relaxed</option>
                                               <option value="profressional">💼 Professional</option>
                                               <option value="bold">💪 Bold</option>
                                               <option value="adventurous">⛺️ Adventurous</option>
                                               <option value="witty">💡 Witty</option>
                                               <option value="funny">😊 Funny</option>
                                               <option value="persuasive">🧠 Persuasive</option>
                                               <option value="empathetic">🤗 Empathetic</option>
                                           </select>
                                           
                                        </div>
                                 </div>
                                 @endif

                          
                             <div class="field full mt-3 w-100">
                            <label for="keywords">Word Limit</label>
                            <input type="number" name="words_limit" min=200 max={{$remaining_words}} value="200">
                            </div>
                            </div>
								
						
                            <div class="submit-form">
                             
                                @if($get_details->variant == 1 )
                                <div class="outputs_cnt" data-toggle="popover" data-placement="top"
                                    data-content="Number of results (max. 8)" data-original-title="" title="">
                                    <input type="number" min="1" @if($id != 27)  max="5" @else max={{(int)($remaining_words/$words_per_image)}}  @endif value="1" name="variants" id="variants" style="height: 45px;">
                                </div>    
                                @endif
                                 <button type="submit" class="btn btn-primary btn-submit" id="gen_btn"><span
                                        class="submit-name">Generate</span></button>
                                 &nbsp; <button id="loading-image" class="btn btn-primary" type="button" disabled style="display: none">
                                              <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                              Generating...
                                            </button>
                                           
                               
                            </div>
                        </form>



                    </div>
                </div>
                <div class="tip mt-3"><i class="mdi mdi-information-outline"></i>
                    <p>Getting low quality results? write a better description.</p>
                </div>
            </div>
            <div class="col-md-8 grid-margin ideabox">
                <div class="card">
                    <div class="ideabar flex content-center justify-between items-center">
                        <div class="ideabuttons flex">
                            <div class="new active">New</div>
                           
                        </div>
                       
                    </div>
                    <div class="card-body ideacontent" >
                        <div class="loading-results text-center" style="display:none"  id="loading-image2">
                            <div class="dot-opacity-loader">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <h2>Generating Ideas</h2>
                            <p class="description">Please wait, AI can take up to 30 seconds!</p>
                        </div>
                        <div class="height-align text-center new"  id="hideit">
                            <p class="text-gray explainer">Generate results by filling up the form on the left and clicking
                                on "Generate".</p>
                        </div>
                         <div class="height-align text-center new">
                                <center>
                            <div class="big-icon" id="loading-text">See results here</div>
                           <div class="col-12 mt-4  mb-3" style="display:none" id="loading-card">
                           <div class="card  mb-3" id="msg" >

                                  </div>
                        </div></center>
                     
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-md-12 col-lg-12 col-sm-12 col-xs-12 d-flex align-items-stretch grid-margin stretch-card mobileeditor">

        <div class="card">
            <form method="post" id="newform1">
             @csrf
            <div class="card-body">
                 <div class="d-flex">
                <h4 class="card-title w-100">Update Project ({{$getproject->project_id}})</h4>
                <div  style="float:right !important">
                      <div class="col-12 d-flex">
                        <div id="saved"></div>
                <button type="submit" class="btn btn-outline-success btn-submit1" style="float:right !important"><span id="save_button">Update</span><span  id="save_button11" style="display:none">Updated</span></button>
                &nbsp; <button id="loading-image1" class="btn btn-primary" type="button" disabled style="display: none">
                                              <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                              Updating...
                                            </button>
                                        </div>
                </div>
            </div><br>
             <textarea name="template" id="summernote" style="height: calc(100vh - 58px) !important;" rows="100">{!! $getproject->project_text !!}</textarea>

               <input type="hidden" name="tem_id"  value="{{$id}}">
                <input type="hidden" name="proj_id"  value="{{$getproject->id}}">
             
               <script>
      $('#summernote').summernote({
        placeholder: 'Edit your text Here',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    </script>
            </div>
           </form>
        </div>
                   
       </div>
        
    </div>
   


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>




               <script type="text/javascript">
               
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
               
                $(".btn-submit").click(function(e){
              
                    e.preventDefault();
               
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                     $('#loading-image').show();
                $.ajax({

                    type: "POST",
                    url: '<?php echo e(route('get_result')); ?>',
                    data: $('#newform').serializeArray(),
                    success: function (data) {
                        $('#msg').html(data);
                         $('#loading-image').hide();
                         $('#loading-text').show();
                          $('#loading-card').show();
                    }
                });

     
               

              
                });
            </script>


            <script type="text/javascript">
               
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
               
                $(".btn-submit1").click(function(e){
              
                    e.preventDefault();
               
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });


                     $('#loading-image1').show();
                $.ajax({

                    type: "POST",
                    url: '<?php echo e(route('update_project')); ?>',
                    data: $('#newform1').serializeArray(),
                    success: function (data) {
                        $('#saved').html(data);
                         $('#loading-image1').hide();
                         $('#save_button').hide();
                         $('#save_button11').show();
                         
                    }
                });

     
               

              
                });
            </script>
    </div>
                   
       </div>
        
    </div>
@endsection





