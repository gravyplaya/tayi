<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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


 <div class="card col-6 m-2" style="float:left !important">
<form action="{{route('save_image')}}" method="post" id="imform{{$i}}">
	@csrf

	<div class="card-header" style="min-height: 70px;">
    <div class="card-title"> <button type="submit" class="copy-text btn btn-inverse-secondary btn-submit{{$i}}" style="float:right;" id="get_btn{{$i}}">save </button> 
        <button type="submit" class="copy-text btn btn-inverse-secondary" style="float:right;display:none;" id="loading-imagei{{$i}}">saving </button> 
        <button type="submit" class="copy-text btn btn-inverse-secondary" style="float:right;display:none;" id="loading-image2{{$i}}">saved </button>&nbsp;&nbsp;&nbsp;&nbsp;
        <a style="float:right !important" href="{{$url_aws}}images/{{$value['name'][$j]}}"  class="btn btn-primary" download="{{$value['name'][$j]}}"> <i class="fa-solid fa-download"></i>
        </a>&nbsp;
        </div>
    </div>
  <div class="card-body" id="text{{$i}}">
  
    <img src="{{$value['url']}}" alt="image" style="width:200px">
    <input type="hidden" value="{{$value['url']}}" name="img_url">
    <input type="hidden" value="{{$value['resolution']}}" name="resolution">
    <input type="hidden" value="{{$value['name'][$j]}}" name="name">
    <input type="hidden" value="{{$value['title']}}" name="title">
    </div>
   
</form>
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
<?php $i++;
$j++; ?>

</div><br>
	</div>
<div class="card-footer">
    @php($words_per_image=\App\Models\Setting::where('name','words_per_image')->first()->value)
	<p style="float:right" class="text-muted">total words used : {{$j * $words_per_image}}</p>
</div>
</div>


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
            $('#loading-image2').show();
            $.ajax({

                type: "POST",
                url: '<?php echo e(route('get_result')); ?>',
                data: $('#newform').serializeArray(),
                success: function(data) {
                    $('#msg').html(data);
                    $('#loading-image').hide();
                    $('#loading-image2').hide();
                    $('#hideit').hide();
                    $('#loading-text').show();
                    $('#loading-card').show();
                     $('#gen_btn').show();
                }
            });





        });
    </script>

      <script src="{{url('user_assets/vendors/feather-icons/feather.min.js')}}"></script>