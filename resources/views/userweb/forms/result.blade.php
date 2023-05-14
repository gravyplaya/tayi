<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php $j=0; ?>
<div class="card">
	<div class="card-header p-2">
		<div class="card-title">Results  <div class="row w-100" style="float:right !important;flex-direction: row-reverse !important;"><div class="button-group w-100 d-flex" style="float:right !important;flex-direction: row-reverse !important;"><div id="like0"></div></div></div> <div class="row w-100" id="get-btnnnn0"  style="float:right !important;flex-direction: row-reverse !important;"><div class="button-group w-100 d-flex" style="float:right !important;flex-direction: row-reverse !important;"><form id="dislikeform0" method="post">@csrf <input type="hidden" name="jid" value="{{$j}}"><input type="hidden" name="id" value="{{$html->history_id}}"><button type="submit" class="copy-text btn btn-inverse-secondary btn-dislike0" style="float:right;"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> </button></form> &nbsp; &nbsp;<form id="likeform0" method="post">@csrf <input type="hidden" name="jid" value="{{$j}}"><input type="hidden" name="id" value="{{$html->history_id}}"><button type="submit" class="copy-text btn btn-inverse-secondary btn-like0" style="float:right;"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> </button></form></div></div></div>
		</div>
	<div class="card-body">
 @php($open_ai_model=\App\Models\Setting::where('name','open_ai_model')->first()->value)
<?php $i=1; ?>
@foreach($html->choices as $comm)
<?php 
if($open_ai_model=="chatGPT"){
$check1=$comm->message->content;
$checke1=str_replace("\n\n",'<br><br>',$check1);
$checke2=str_replace("\n",'<br>',$check1);
}else{
  $check1=$comm->text;	
 $checke1=str_replace("\n\n",'<br><br>',$check1);
$checke2=str_replace("\n",'<br>',$check1);
}
?>

<div class="card">
	<div class="card-header p-2">
	<div class="card-title"> <button class="copy-text btn btn-inverse-secondary" id="btn{{$i}}" onclick="copyText{{$i}}()" style="float:right;">Copy </button></div>
		</div>
  <div class="card-body" id="text{{$i}}">
<p style="font-size:20px"><b>Variant {{$i}} : </b>{!! $checke2 !!}</p>
</div></div><br>
<script>
	function copyText{{$i}}(){
  const text = document.getElementById('text{{$i}}').innerText
  const btnText = document.getElementById('btn{{$i}}')
  navigator.clipboard.writeText(text);
  btnText.innerText = "Copied Text"
   }
</script>
<?php $i++; ?>
@endforeach
	</div>
<div class="card-footer">
	<p style="float:right" class="text-muted">total words used : {{$html->usage->total_tokens}}</p>
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

        $(".btn-like0").click(function(e) {

            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
             

            $.ajax({

                type: "POST",
                url: '<?php echo e(route('like')); ?>',
                data: $('#likeform0').serializeArray(),
                success: function(data) {
                  $('#like0').html(data);
                    $('#get-btnnnn0').hide();
                    
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

        $(".btn-dislike0").click(function(e) {

            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
             

            $.ajax({

                type: "POST",
                url: '<?php echo e(route('dislike')); ?>',
                data: $('#dislikeform0').serializeArray(),
                success: function(data) {
                  $('#like0').html(data);
                    $('#get-btnnnn0').hide();
                    
                }
            });





        });
    </script>

