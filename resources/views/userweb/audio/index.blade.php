@extends('userweb.layout.app')

@section('content')
    <style>
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

        .card .card-body {
            padding: 20px 25px;
        }

        .custom-toggler input:checked+label {
            background: #55B589;
        }

        .custom-toggler label {
            cursor: pointer;
            text-indent: -9999px;
            width: 40px;
            height: 26px;
            background: #E3E3E3;
            display: block;
            border-radius: 100px;
            position: relative;
            margin-bottom: 0;
        }

        .setting-row:last-child {
            border: none;
            padding-bottom: 10px;
        }

        .setting-row {
            border-bottom: 1px solid rgb(203, 213, 224, .5);
            padding: 20px 0 20px 5px;
            align-items: center;
            display: flex;
        }

        .space-between {
            justify-content: space-between;
        }

        .flex {
            display: flex;
        }

        .custom-toggler input[type=checkbox] {
            height: 0;
            width: 0;
            visibility: hidden;
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

        input[type="radio"],
        input[type="checkbox"] {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            padding: 0;
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

        .card .card-title h4 {
            /* font-family: "Plus Jakarta"; */
            font-weight: 600;
            font-size: 16px;
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

        .setting-row div:first-child span {
            color: #4a5568;
            font-weight: 500;
        }

        a,
        div,
        h1,
        h2,
        h3,
        h4,
        h5,
        p,
        span {
            text-shadow: none;
        }

        .setting-row:first-child {
            padding-top: 0px;
        }




        .grid-margin {
            margin-bottom: 30px;
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

        .card .card-body {
            padding: 2.5rem 2.5rem;
        }

        .card-settings .row-form.halfed {
            display: flex;
            width: 100%;
            justify-content: space-between;
            align-items: stretch;
        }

        .card-settings .row-form {
            margin-bottom: 15px;
        }

        .card-settings .row-form.halfed>div {
            width: calc(50% - 9px);
        }

        .card-settings .btn {
            color: #001737;
        }

        .submit-form-row {
            margin-top: 20px;
        }

        .card-body {
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.25rem;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Search
        </h2>
    </x-slot>
    <div>
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
        <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6 col-xl-6 pr-3 p-4"  style="float:left">
              
                <div class="grid-margin" style="width:100%">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>Transcribe Audio</h4>
                            </div></div>
                        <div class="card-body card-settings">
                            
                          <form class="forms-sample" method="post"  id="newform" enctype="multipart/form-data">
									@csrf
									
                            
                           <?php  $remaining_minutes=auth()->user()->speech_minutes - auth()->user()->minutes_reached; ?>     
						<div>
                             <label id="folderLabel">Select Audio File(which length should be less than {{$remaining_minutes}} minutes and size should be less than 25 mb)</label>
							<input class="form-control" type="file" name="audio_file">
						</div>
                        <br>
                        <div class="form-group">
                         <label id="folderLabel">Select Output Language</label>
                         
                         <select name="language" class="form-control" required>
                           <option value="af">Afrikaans  </option>
							<option value="ar">Arabic</option>
							<option value="hy">Armenian</option>
							<option value="az">Azerbaijani</option>
							<option value="be">Belarusian </option>
							<option value="bs">Bosnian</option>
							<option value="bg">Bulgarian</option>
							<option value="ca">Catalan</option>
							<option value="zh">Chinese</option>
							<option value="hr">Croatian</option>
							<option value="cs">Czech </option>
							<option value="da">Danish </option>
							<option value="nl">Dutch</option>
							<option value="en">English</option>
							<option value="et">Estonian</option>
							<option value="fi">Finnish</option>
							<option value="fr">French</option>
							<option value="gl">Galician</option>
							<option value="de">German </option>
							<option value="el">Greek </option>
							<option value="he">Hebrew </option>
							<option value="he">Hebrew</option>
							<option value="hi">Hindi </option>
							<option value="hu">Hungarian</option>
							<option value="is">Icelandic</option>
							<option value="id">Indonesian </option>
							<option value="it">Italian</option>
							<option value="ja">Japanese</option>
							<option value="kn">Kannada </option>
							<option value="kk">Kazakh </option>  
						    <option value="ko">Korean </option>
							<option value="lt">Lithuanian - lietuvių</option>
							<option value="lv">Latvian - latviešu</option>
							<option value="mk">Macedonian - македонски</option>
							<option value="ms">Malay - Bahasa Melayu</option>
							<option value="mr">Marathi - मराठी</option>
							<option value="mi">Maori</option>
							<option value="ne">Nepali</option>
							<option value="nn">Norwegian</option>
							<option value="fa">Persian</option>
							<option value="pl">Polish</option>
							<option value="pt">Portuguese</option>
							<option value="ro">Romanian</option> 
							<option value="ru">Russian</option>
							<option value="sr">Serbian</option>
							<option value="sk">Slovak</option>
							<option value="sl">Slovenian</option>
							<option value="es">Spanish</option>
							<option value="sw">Swahili</option>
							<option value="sv">Swedish</option>
							<option value="tl">Tagalog</option>
							<option value="ta">Tamil</option>
							<option value="th">Thai</option>
							<option value="tr">Turkish</option>
							<option value="uk">Ukrainian</option>
							<option value="ta">Tamil</option>
							<option value="ur">Urdu</option>
							<option value="vi">Vietnamese</option>  
                        </select>
                        
                       </div>
								
                                <div class="submit-form-row">
                                    <button type="submit" class="btn btn-primary rounded shadow-sm btn-sm  text-white btn-submit" id="gen_btn">Transcript</button>
                                      &nbsp; <button id="loading-image" class="btn btn-primary" type="button" disabled style="color:white; display: none">
                                              <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                               Transcripting...
                                            </button>
                                </div>
                          
                            </form>
                        </div>
                    </div>
                </div>

      </div>
       <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6 col-xl-6 p-4" style="float:left">
   
               <div class="card">
          
            <div class="card-body">
                
                 <h6 class="text-muted mb-2">See results here</h6>
      
                  <p id="resultdata"></p>
        </div>
                   
       </div>

                               
      </div>
  </div><hr>
  <div class="row">
       <!-- ///translate audio// -->
        <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6 col-xl-6 pr-3 p-4"  style="float:left">
              
                <div class="grid-margin" style="width:100%">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>Translate Audio in english</h4>
                            </div></div>
                        <div class="card-body card-settings">
                            
                          <form class="forms-sample" action="{{route('audio_translate')}}" id="transslate" enctype="multipart/form-data" method="post">
                                    @csrf
                                    
                            
                                
                                    <div>
                                         <label id="folderLabel">Select Audio File(which length should be less than {{$remaining_minutes}} minutes and size should be less than 25 mb)</label>
                                        <input class="form-control" type="file" name="audio_file" id="formFile">
                                    </div>

                                
                                <div class="submit-form-row">
                                    <button type="submit" class="btn btn-primary rounded shadow-sm btn-sm  text-white btn-translsate" id="gen_btsntra">Translate</button>
                                      &nbsp; <button id="loading-imagetra" class="btn btn-primary" type="button" disabled style="color:white; display: none">
                                              <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                               Translating...
                                            </button>
                                </div>
                          
                            </form>
                        </div>
                    </div>
                </div>

      </div>
     
              <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6 col-xl-6 p-4" style="float:left">
   
               <div class="card">
          
            <div class="card-body">
                
                 <h6 class="text-muted mb-2">See results here</h6>
      
                  <p id="resultdatatra"></p>
        </div>
                   
       </div>

                               
      </div>
  </div>
</div>



     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn-submit").click(function(e) {

            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
             $('#gen_btn').hide();
            $('#loading-image').show();
            var formData = new FormData($("#newform")[0]);

            $.ajax({

                type: "POST",
                url: '<?php echo e(route('audio_to_text')); ?>',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                  $('#resultdata').html(data);
                    $('#loading-image').hide();
                     $('#gen_btn').show();
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

        $(".btn-translate").click(function(e) {

            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
             $('#gen_btntra').hide();
            $('#loading-imagetra').show();
            var formData = new FormData($("#translate")[0]);

            $.ajax({

                type: "POST",
                url: '<?php echo e(route('audio_translate')); ?>',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                  $('#resultdatatra').html(data);
                    $('#loading-imagetra').hide();
                     $('#gen_btntra').show();
                }
            });


        });
    </script>


  
@endsection


