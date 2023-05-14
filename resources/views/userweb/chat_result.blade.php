<?php $i=1; ?>
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

@php($favicon=\App\Models\Setting::where('name','favicon')->first()->value)
@foreach($html as $chat)
<?php 
$check=str_replace("\n\n",'<br>',$chat->message);
$check1=str_replace("\n",'<br>',$check);?>
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
<?php $i++; ?>
@endforeach
 <div id="mymessage"></div>



   