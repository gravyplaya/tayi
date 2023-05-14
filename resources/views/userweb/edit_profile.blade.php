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
        <div style="margin:0px auto 100px" align="center">
            <h1 class="nd">Account Settings</h1>
            <div class="row mt-4" style="width: 670px;">
                <div class="grid-margin" style="width:100%;">
                    <div class="card">
                        <div class="card-body card-settings">
                            <div class="card-title">
                                <h4>Language Settings</h4>
                            </div>
                            <div class="settings-list">
                                   <form action="{{route('set_language')}}" method="post">
                  @csrf
                  <div class="modal-body">
                    
                      <div class="form-group">
                         <label id="folderLabel">Select Input Language</label>
                         
                         <select name="input_lang" class="form-control" required>
                           @php($languages= \App\Models\Language::get())
                                        @foreach($languages as $lang)
                                           <option value="{{$lang->name}}"  @if(auth()->user()->input_lang == $lang->name) selected @endif   style="background-image:url({{url('user_assets/images/noprojects.png')}});">{{$lang->flag}} {{ucfirst($lang->name)}}</option>
                                         @endforeach
                        </select>
                        
                       </div>
                        <br>

                       <div class="form-group">
                         <label id="folderLabel">Select Output Language</label>
                         
                         <select name="output_lang" class="form-control" required>
                           @php($languages= \App\Models\Language::get())
                                @foreach($languages as $lang)
                                   <option value="{{$lang->name}}" @if(auth()->user()->output_lang == $lang->name) selected @endif>{{$lang->flag}} {{ucfirst($lang->name)}}</option>
                                 @endforeach
                        </select>
                        
                       </div>
                      
                    
                  </div><br>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary rounded shadow-sm btn-sm text-white">Save</button>
                  </div>
                </form>
                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid-margin" style="width:100%">
                    <div class="card">
                        <div class="card-body card-settings">
                            <div class="card-title">
                                <h4>Account Information</h4>
                            </div>
                          <form class="forms-sample" action="{{'update-user-profile'}}" method="post"  enctype="multipart/form-data">
									@csrf
									 <div class="mb-3">
                                    <img class="wd-80 ht-80 rounded-circle" src="{{$url_aws}}user/{{auth()->user()->image}}" alt="">
                            </div>
                                <div class="row-form halfed">
                                    <div>
                                        <label for="firstname">Full Name</label>
                                        <input type="text" class="form-control" name="name" id="exampleInputUsername2" placeholder="Name" value="{{auth()->user()->name}}">
                                    </div>
                                    <div>
                                        <label for="lastname">Email</label>
                                       <input type="email" class="form-control" id="exampleInputEmail2" autocomplete="off" placeholder="Email" value="{{auth()->user()->email}}" readOnly disabled>
                                    </div>
                                </div>
                                <div class="row-form halfed">
                                <div>
                                    <label for="new-email">password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword2" name="password" autocomplete="off" placeholder="Insert password if you want to change">
                                </div>
                                
									<div>
										<label for="exampleInputUsername2">Profile Image</label>
										<input class="form-control" type="file" name="image" id="formFile">
									</div>
								</div>
                                <div class="submit-form-row">
                                    <button type="submit" class="btn btn-primary rounded shadow-sm btn-sm  text-white">Save</button>
                                </div>
                          
                            </form>
                        </div>
                    </div>
                </div>
              
            </div>




        </div>
    </div>
@endsection


