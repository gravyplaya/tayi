
@extends('userweb.layout.app')

 @php($favicon=\App\Models\Setting::where('name','favicon')->first()->value)
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
    .chat-history {
            height: 60vh;
            overflow-y: scroll;
        }

     .people-list {
            height: 70vh;
            overflow-y: scroll;
        }
   

    body{
        background-color: #f4f7f6;
        margin-top:20px;
    }
    .card {
        background: #fff;
        transition: .5s;
        border: 0;
        margin-bottom: 30px;
        border-radius: .55rem;
        position: relative;
        width: 100%;
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
    }
    .chat-app .people-list {
        width: 280px;
        position: absolute;
        left: 0;
        top: 0;
        padding: 20px;
        z-index: 7
    }

    .chat-app .chat {
        margin-left: 280px;
        border-left: 1px solid #eaeaea
    }

    .people-list {
        -moz-transition: .5s;
        -o-transition: .5s;
        -webkit-transition: .5s;
        transition: .5s
    }

    .people-list .chat-list li {
        padding: 10px 15px;
        list-style: none;
        border-radius: 3px
    }

    .people-list .chat-list li:hover {
        background: #efefef;
        cursor: pointer
    }

    .people-list .chat-list li.active {
        background: #efefef
    }

    .people-list .chat-list li .name {
        font-size: 15px
    }

    .people-list .chat-list img {
        width: 45px;
        border-radius: 50%
    }

    .people-list img {
        float: left;
        border-radius: 50%
    }

    .people-list .about {
        float: left;
        padding-left: 8px
    }

    .people-list .status {
        color: #999;
        font-size: 13px
    }

    .chat .chat-header {
        padding: 15px 20px;
        border-bottom: 2px solid #f4f7f6
    }

    .chat .chat-header img {
        float: left;
        border-radius: 40px;
        width: 40px
    }

    .chat .chat-header .chat-about {
        float: left;
        padding-left: 10px
    }

    .chat .chat-history {
        padding: 20px;
        border-bottom: 2px solid #fff
    }

    .chat .chat-history ul {
        padding: 0
    }

    .chat .chat-history ul li {
        list-style: none;
        margin-bottom: 30px
    }

    .chat .chat-history ul li:last-child {
        margin-bottom: 0px
    }

    .chat .chat-history .message-data {
        margin-bottom: 15px
    }

    .chat .chat-history .message-data img {
        border-radius: 40px;
        width: 40px
    }

    .chat .chat-history .message-data-time {
        color: #434651;
        padding-left: 6px
    }

    .chat .chat-history .message {
        color: #444;
        padding: 18px 20px;
        line-height: 26px;
        font-size: 16px;
        border-radius: 7px;
        display: inline-block;
        position: relative
    }

    .chat .chat-history .message:after {
        bottom: 100%;
        left: 7%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-bottom-color: #fff;
        border-width: 10px;
        margin-left: -10px
    }

    .chat .chat-history .my-message {
        background: #efefef
    }

    .chat .chat-history .my-message:after {
        bottom: 100%;
        left: 30px;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-bottom-color: #efefef;
        border-width: 10px;
        margin-left: -10px
    }

    .chat .chat-history .other-message {
        background: #e8f1f3;
        text-align: right
    }

    .chat .chat-history .other-message:after {
        border-bottom-color: #e8f1f3;
        left: 93%
    }

    .chat .chat-message {
        padding: 20px
    }

    .online,
    .offline,
    .me {
        margin-right: 2px;
        font-size: 8px;
        vertical-align: middle
    }

    .online {
        color: #86c541
    }

    .offline {
        color: #e47297
    }

    .me {
        color: #1d8ecd
    }

    .float-right {
        float: right
    }

    .clearfix:after {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0
    }

    @media only screen and (max-width: 767px) {
        .chat-app .people-list {
            height: 465px;
            width: 100%;
            overflow-x: auto;
            background: #fff;
            left: -400px;
            display: none
        }
        .chat-app .people-list.open {
            left: 0
        }
        .chat-app .chat {
            margin: 0
        }
        .chat-app .chat .chat-header {
            border-radius: 0.55rem 0.55rem 0 0
        }
        .chat-app .chat-history {
            height: 300px;
            overflow-x: auto
        }
    }

    @media only screen and (min-width: 768px) and (max-width: 992px) {
        .chat-app .chat-list {
            height: 650px;
            overflow-x: auto
        }
        .chat-app .chat-history {
            height: 600px;
            overflow-x: auto
        }
    }

    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
        .chat-app .chat-list {
            height: 480px;
            overflow-x: auto
        }
        .chat-app .chat-history {
            height: calc(100vh - 350px);
            overflow-x: auto
        }
    }
</style>
<?php 
 $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    $length=10;
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
if($chat_id != "" && $chat_id != NULL){
  $chatsession=$chat_id;
}else{

 $chatsession=Session::get('chat_session');
 if($chatsession == NULL){
  Session::put('chat_session', "chat_".$randomString);
  Session::save();

  $chatsession=Session::get('chat_session');
 }
}


$chats=\App\Models\Chat::where('chat_id',$chatsession)->get();

$chat_session= $chatsession;
 if($chat_session == NULL || $chat_session==""){
  Session::put('chat_session', "chat_".$randomString);
  Session::save();
 }
 $tools = \App\Models\Chat::where('user_id', auth()->user()->id)->get();
 $chats_ids = $tools->unique('chat_id');
?>
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <div class="container" style="height: 50vh;">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card chat-app">
                    <div id="plist" class="people-list">
                        <ul class="list-unstyled chat-list mt-2 mb-0">
                            <li class="clearfix">
                                <div class="about w-100" align="center">
                                     <a class="btn btn-outline-primary" href="{{route('new_chat')}}">Start New Chat </a>
                                </div>
                            </li>
                            @foreach($chats_ids as $chatss)
                            <li class="clearfix active" @if($chatsession==$chatss->chat_id) style="border:2px solid orange" @endif>
                                <a href="{{route('reopened_chat', $chatss->chat_id)}}">
                                <img src="{{$url_aws}}admin/{{$favicon}}" alt="avatar">
                                <div class="about">
                                    <div class="name">{{$chatss->chat_id}}</div>
                                    <div class="status">{{date('d-M-y h:i s',strtotime($chatss->created_at))}}</div>
                                </div></a>
                            </li><hr>
                            @endforeach
                           
                        </ul>
                    </div>
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-8">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                        <img src="{{$url_aws}}admin/{{$favicon}}" alt="avatar">
                                    </a>
                                     @php($appname=\App\Models\Setting::where('name','app_name')->first()->value)
                                    <div class="chat-about">
                                        <h6 class="m-b-0">{{$appname}}</h6>
                                        <small>Last seen: few seconds ago</small>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="chat-history"  id="chatbody">
                            <ul class="m-b-0">
                                 <div id="msg"></div>
                             <div id="chatt">
                                @foreach($chats as $chat)
                                <li class="clearfix">
                                     <div class="message-data  @if($chat->role=='user') text-right @endif"  @if($chat->role=='user') style = "text-align: right;" @endif>
                                        @if($chat->role=='user')
                                        <span class="message-data-time">{{date('d-M-Y',strtotime($chat->created_at))}}</span>
                                         <img src="{{$url_aws}}user/{{auth()->user()->image}}" alt="avatar">
                                         @else
                                            <img src="{{$url_aws}}admin/{{$favicon}}" alt="avatar">
                                            <span class="message-data-time">{{date('d-M-Y',strtotime($chat->created_at))}}</span>
                                         @endif
                                    </div>
                                    <div class="message  @if($chat->role=='user') other-message  float-right @else my-message @endif"> {!! $chat->message !!} </div>
                                </li>
                                @endforeach
                                <div id="mymessage"></div>
                            </div>
                                 <li class="clearfix">
                                    <div class="message my-message" id="loading-image" style="display: none;">
                                        <button class="btn btn-primary" type="button" disabled>
                                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                         Typing...
                                         </button></div>
                                </li>
                                
                               
                            </ul>
                        </div>

                        <div class="chat-message clearfix">
                             <form method="post" id="newform">
                                   @csrf
                            <div class="input-group mb-0">
                                <input type="hidden" name="chat_session" value="{{$chat_session}}">
                                <input type="text" name="prompt" id="prompt" class="form-control" placeholder="Enter text here...">
                                <button type="submit" class="input-group-prepend btn-submit" style="border: none;">
                                    <span class="input-group-text"><i class="fa fa-send"></i></span>
                                </button>
                            </div>
                            </form>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>


    <script type="text/javascript">
        $("#chatbody").scrollTop($("#chatbody")[0].scrollHeight);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn-submit").click(function(e) {

            e.preventDefault();
            var text = document.getElementById("prompt").value;
            html='<li class="clearfix"><div class="message-data text-right" style = "text-align: right;"><span class="message-data-time">10:10 AM, Today</span><img src="{{url('storage/app/public/user/')}}/{{auth()->user()->image}}" alt="avatar"></div><div class="message other-message float-right">'+text+' </div></li>';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $('#loading-image').show();
             $('#mymessage').html(html);
            $.ajax({
                
                type: "POST",
                url: '<?php echo e(route('chat_competions')); ?>',
                data: $('#newform').serializeArray(),
                success: function(data) {
                    $('#msg').html(data);
                    $('#loading-image').hide();
                    $('#chatt').hide();
                    $("#prompt").val("");
                }
            });

        });
    </script>


@endsection






