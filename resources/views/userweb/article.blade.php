<!DOCTYPE html>
@extends('userweb.layout.app')
@php($get_user_details=\App\Models\User::where('id',auth()->user()->id)->first())
@php($get_user_plan_details=\App\Models\SubMembership::with('mem')->where('id',$get_user_details->plan_id)->first())
@php($remaining_words = $get_user_details->tokens - $get_user_details->token_reached);
@section('content')
    <style>
        .blog-writer-head {
            text-align: center;
            margin: 20px 0 20px;
        }

        .blog-writer-head h1 {
            font-size: 38px;
            color: #0E212F;
            margin-bottom: 15px;
        }

        .model_page {
            margin-top: 20px;
        }

        .text-center {
            text-align: center !important;
        }

        .subheadings .srow,
        .structure .srow {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            position: relative;
        }

        .srow .right-actions {
            display: flex;
            align-items: center;
            height: 40px;
            margin-left: 7px;
            z-index: 1;
            position: absolute;
            right: 8px;
        }

        .row {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -9px;
            margin-left: -9px;
        }

        .mdi-plus:before {
            content: "\F415";
        }

        .srow:last-child .right-actions .mdi-plus {
            display: block;
        }

        .srow .right-actions .mdi-plus {
            display: none;
        }



        .srow .right-actions i {
            color: #4a5568;
            font-size: 20px;
            margin: 0 3px;
            transition: all 0.3s ease;
            height: 40px;
            line-height: 39px;
        }

        .srow .right-actions {
            display: flex;
            align-items: center;
            height: 40px;
            margin-left: 7px;
            z-index: 1;
            position: absolute;
            right: 8px;
        }

        .mdi:before,
        .mdi-set {
            display: inline-block;
            font: normal normal normal 24px/1 "Material Design Icons";
            font-size: inherit;
            text-rendering: auto;
            line-height: inherit;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        #generate-subheadings {
            font-size: 9px;
            min-height: 30px;
            height: 33px;
            display: flex;
            align-items: center;
            padding-left: 10px;
            padding-right: 10px;
            transition: all 0.3s ease;
        }

        #generate-subheadings svg {
            width: 14px;
            margin-right: 5px;
        }

        svg {
            overflow: hidden;
            vertical-align: middle;
        }

        #start-generator {
            transition: all 0.3s ease;
        }

        #start-rewriter,
        #start-generator {
            width: 30%;
        }

        .submit-form .btn[disabled]:hover {
            cursor: not-allowed;
            transform: none;
        }

        .submit-form .btn[disabled] {
            color: #718096;
            background: #E2E8F0;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 10%), 0 1px 2px 0 rgb(0 0 0 / 6%);
            border: 1px solid #cbd5e0;
        }

        .submit-form .btn:hover,
        .save-download-form .btn:hover {
            background: #402CBD;
        }

        .submit-form .btn,
        .save-download-form .btn {
            min-height: 25px;
            height: 45px;
            line-height: 1;
            border: none;
            width: 100%;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 10%), 0 1px 2px 0 rgb(0 0 0 / 6%);
            /* font-family: "Plus Jakarta"; */
            font-weight: 600;
            font-size: 15px;
            background: #2e16e6;
            position: relative;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: rgb(90, 39, 231);
        }

        .btn-primary:not(.btn-light),
        .wizard>.actions a:not(.btn-light) {
            color: #ffffff;
        }

        #start-box,
        #blog-area,
        .box-center {
            margin-left: auto;
            margin-right: auto;
        }

        .grid-margin {
            margin-bottom: 30px;
        }

        #article-rewriter #step1 .submit-form,
        #article-generator #step1 .submit-form {
            margin-top: 20px;
        }



        .card {
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 10%), 0 1px 2px 0 rgb(0 0 0 / 6%);
            border-radius: 6px;
        }



        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.3125rem;
        }

        .submit-form {
            margin-top: 20px;
        }


        .col-md-8 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 66.66667%;
            flex: 0 0 66.66667%;
            max-width: 66.66667%;
        }

        #article-generator .card label {
            margin-bottom: 10px;
        }

        .card label {
            color: #4a5568;
            font-weight: 500;
            font-size: 14px;
            display: block;
            line-height: 20px;
            margin-bottom: 6px;
        }

        label {
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        #article-generator .field {
            margin-bottom: 15px;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 4px;
        }

        #article-generator input {
            transition: all 0.3s ease;
        }

        .card input {
            padding: 8px 12px;
            height: 40px;
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

        div.tagsinput {
            border: 1px solid #CCC;
            background: #FFF;
            padding: 5px;
            width: 300px;
            height: 100px;
            overflow-y: auto;
        }

        div.tagsinput {
            padding: 15px 15px 10px;
            border-color: rgba(151, 151, 151, 0.3);
        }

        .tagsinput {
            background: #edf2f7 !important;
            border-radius: 4px;
            border: 1px solid rgba(226, 232, 240) !important;
            padding: 4px 5px !important;
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 5%);
        }

        .tagsinput {
            background: #fff !important;
            border-radius: 4px;
            border: 1px solid rgba(226, 232, 240) !important;
            overflow: hidden !important;
        }

        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 28px;
            user-select: none;
            -webkit-user-select: none;
        }


.navbar {
    margin-top: -22px !important;
}
.progress-bar{
    height:100% !important;
}
    </style>

 
    <div class="container">

        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow-1">
                    
         <div class="row" id="article"></div>
	   
    
     
       
          <div id="article_generator">          
        <div class="blog-writer-head">
            <h1>Generate Articles With AI</h1>
            <p class="subhead" style="font-size:15px;margin-bottom: 30px;">Turn a title and outline into a long and engaging
                article.</p>
        </div>
          
                <div class="card">
                    <div class="card-body">
                        <form id="articsleform" method="post">
                            @csrf
                        <div class="field">
                            <label for="language">Language</label>
                            <select name="lang" id="language" required="" data-select2-id="select2-data-language"
                                tabindex="-1" class="select2-hidden-accessible" aria-hidden="true" required>
                                 @php($languages= \App\Models\Language::get())
                                        @foreach($languages as $lang)
                                           <option value="{{$lang->name}}"  @if(auth()->user()->input_lang == $lang->name) selected @endif   style="background-image:url({{url('user_assets/images/noprojects.png')}});">{{$lang->flag}} {{ucfirst($lang->name)}}</option>
                                         @endforeach
                            </select>
                        </div>
                        <div class="field">
                            <label for="blog_title">Article title*</label>
                            <input type="text" id="blog_title" name="title"
                                placeholder="e.g. 25 best places to visit in India 2023">
                        </div>
                       
                        <div class="field">
                            <label for="keywords">Focus Keywords <span class="text-gray">(separated with a
                                    comma)</span></label>
                            <input type="text" id="keywords" name="keywords" placeholder="Add keyword" required>
                        </div>

                        <div class="field subheadings" style="margin-top:-2px;">
                            <label for="subheadings"
                                style="display: flex;align-items: center;justify-content: space-between;"><span
                                    style="margin-top: 6px;">Article subheadings* </span>
                            </label>
                            <div class="srows ui-sortable" id="dynamicTable">
                                <div class="srow ui-sortable-handle">
                                    <div class="left-actions">
                                        <i class="mdi mdi-menu"></i>
                                    </div>
                                    <input type="text" class="subheading" id="subheading" name="addmore[]"
                                        placeholder="Subheading" required>
                                    <div class="right-actions">
                                        <a type="button" name="add" id="add" class=""><i
                                                class="fa fa-plus" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
						@php($words_per_image=\App\Models\Setting::where('name','words_per_image')->first()->value)
                       <div class="field">
                            <label for="keywords">No. of Images ({{$words_per_image}} words per image will be deducted)</label>
                            <input type="number" name="images" max={{(int)$remaining_words/$words_per_image}}>
                        </div>
                        <div class="field">
                            <label for="keywords">Word Limit</label>
                            <input type="number" name="words_limit" value="200" max=1000>
                        </div>
                 
                <center class="mt-2">
                    <button type="submit" class="btn btn-primary text-center justify-content-center btn-susbmit" id="start-generator" style="width:40%;" align="center">Write my
                        article</button>
					 &nbsp; <button id="loading-image" class="btn btn-primary text-center justify-content-center" type="button" disabled style="display: none">
                                              <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                              Generating...
                                            </button>
                </center>
            </form>
            </div>
        
        </div>


        
     
    </div>
				</div></div></div></div>


  


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

               <script type="text/javascript">
               
               
               
             $("#articsleform").submit(function(e) {
                    e.preventDefault();
                     $('#loading-image').show();
					$('#start-generator').hide();
                $.ajax({

                    type: "POST",
                    url: '<?php echo e(route('generated_article')); ?>',
                    data: $('#articsleform').serializeArray(),
                    success: function (data) {
                        $('#article').html(data);
                         $('#loading-image').hide();
                         $('#article_generator').hide();
                       
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
                         
                    }
                });

     
               

              
                });
            </script>


    <script type="text/javascript">
        var i = 0;

        $("#add").click(function() {
            ++i;
            $("#dynamicTable").append('<div class="srow ui-sortable-handle" id="dddd"> <div class="left-actions"> <i class="mdi mdi-menu"></i></div><input type="text" name="addmore[]" placeholder="Subheading" class="subheading" /><div class="right-actions"><a type="button" class="remove-a"><i class="fa fa-minus" aria-hidden="true"></i></a></div></div>'
            );
        });
      

        $(document).on('click', '.remove-a', function() {
            $(this).parents('#dddd').remove();
        });
    </script>
			
			
     

     
@endsection
