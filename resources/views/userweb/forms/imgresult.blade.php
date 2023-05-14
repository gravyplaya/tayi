<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
<div class="card">
	<div class="card-header">
	<div class="card-title">Results </div>
		</div>
	<div class="card-body">

<?php $i=1;
$j=0; ?>
  	<div class="row">

 @foreach ($html['data'] as $key => $value)
 <div class="card col-6 m-2" style="float:left !important">
	 <div class="card-header" style="min-height: 50px;">
	 <div class="card-title">
		
		<div class="row w-100" style="float:right !important;flex-direction: row-reverse !important;"><div class="button-group w-100 d-flex" style="float:right !important;flex-direction: row-reverse !important;"><div id="like{{$j}}"></div></div></div> <div class="row w-100" id="get-btnnnn{{$j}}"  style="float:right !important;flex-direction: row-reverse !important;"><div class="button-group w-100 d-flex" style="float:right !important;flex-direction: row-reverse !important;">
		
		<form id="dislikeforms{{$j}}" method="post">
			@csrf 
			<input type="hidden" name="jid" value="{{$j}}">
			<input type="hidden" name="id" value="{{$html['history_id'][$j]}}">
			<button type="submit" class="btn btn-inverse-secondary btn-dislikes{{$j}}" style="float:right;">
				<i class="fa fa-thumbs-o-down" aria-hidden="true"></i> </button>
		</form> 
		
		&nbsp; &nbsp;<form id="likeform{{$j}}" method="post">@csrf 
		 
		 <input type="hidden" name="jid" value="{{$j}}">
		<input type="hidden" name="id" value="{{$html['history_id'][$j]}}"><button type="submit" class="btn btn-inverse-secondary btn-like{{$j}}" style="float:right;"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> </button></form>
		
		</div></div>
	 </div></div>
<div class="card-header" style="min-height: 70px;">
<form action="{{route('save_image')}}" method="post" id="imform{{$i}}">
	@csrf

	
    <div class="card-title"> <button type="submit" class="copy-text btn btn-inverse-secondary btn-submit{{$i}}" style="float:right;" id="get_btn{{$i}}">save </button> 
        <button type="submit" class="copy-text btn btn-inverse-secondary" style="float:right;display:none;" id="loading-imagei{{$i}}">saving </button> 
        <button type="submit" class="copy-text btn btn-inverse-secondary" style="float:right;display:none;" id="loading-image2{{$i}}">saved </button>&nbsp;&nbsp;&nbsp;&nbsp;
        <a style="float:right !important" href="{{$url_aws}}images/{{$html['name'][$j]}}"  class="btn btn-primary" download="{{$html['name'][$j]}}"> <i class="fa-solid fa-download"></i>
        </a>&nbsp;
	
        </div>
  
  <div class="card-body" id="text{{$i}}">
  
    <img src="{{$value['url']}}" alt="image" style="width:200px">
    <input type="hidden" value="{{$value['url']}}" name="img_url">
    <input type="hidden" value="{{$html['resolution']}}" name="resolution">
    <input type="hidden" value="{{$html['name'][$j]}}" name="name">
    <input type="hidden" value="{{$html['title']}}" name="title">
    </div>
   
</form>
	  </div>
</div>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn-submit{{$i}}").click(function(e) {

            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
             $('#get_btn{{$i}}').hide();
            $('#loading-image{{$i}}').show();
            
            $.ajax({

                type: "POST",
                url: '<?php echo e(route('save_image')); ?>',
                data: $('#imform{{$i}}').serializeArray(),
                success: function(data) {
                    $('#get_btn{{$i}}').hide();
                    $('#loading-image{{$i}}').hide();
                    $('#loading-image2{{$i}}').show();
                }
            });





        });
    </script>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn-like{{$j}}").click(function(e) {

            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
             

            $.ajax({

                type: "POST",
                url: '<?php echo e(route('like')); ?>',
                data: $('#likeform{{$j}}').serializeArray(),
                success: function(data) {
                  $('#like{{$j}}').html(data);
                    $('#get-btnnnn{{$j}}').hide();
                    
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

        $(".btn-dislikes{{$j}}").click(function(e) {

            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
             

            $.ajax({

                type: "POST",
                url: '<?php echo e(route('dislike')); ?>',
                data: $('#dislikeforms{{$j}}').serializeArray(),
                success: function(data) {
                  $('#like{{$j}}').html(data);
                    $('#get-btnnnn{{$j}}').hide();
                    
                }
            });





        });
    </script>
<?php $i++;
$j++; ?>
@endforeach
</div><br>
	</div>
<div class="card-footer">
    @php($words_per_image=\App\Models\Setting::where('name','words_per_image')->first()->value)
	<p style="float:right" class="text-muted">total words used : {{$j * $words_per_image}}</p>
</div>
</div>


      <script src="{{url('user_assets/vendors/feather-icons/feather.min.js')}}"></script>