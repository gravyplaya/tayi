
@php($get_user_details=\App\Models\User::where('id',auth()->user()->id)->first())
@php($get_user_plan_details=\App\Models\SubMembership::with('mem')->where('id',$get_user_details->plan_id)->first())
@php($open_ai_model=\App\Models\Setting::where('name','open_ai_model')->first()->value)
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .note-editable {
    height: 68vh !important;
}
</style>
 <div class="container">

        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow-1">
                    <div class="row">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Search
        </h2>
    </x-slot>
   
    <div>
    <div class="row">
         <h3>Article</h3><hr>
    <div class="row">
        <div class="col-xl-4 col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <div class="card">
    <div class="card-header">
    <div class="card-title">Images Result </div>
        </div>
    <div class="card-body">

<?php $i=1;
$j=0; ?>
  	<div class="row">

 @foreach ($html['data'] as $key => $value)
 <div class="card col-12 m-2" style="float:left !important">
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
<form action="{{route('save_image')}}" method="post" id="imforme{{$i}}">
	@csrf

	<div class="card-header" style="min-height: 70px;">
    <div class="card-title"> <button type="submit" class="copy-text btn btn-inverse-secondary btn-submitss{{$i}}" style="float:right;" id="get_btns{{$i}}">save </button> 
        <button type="submit" class="copy-text btn btn-inverse-secondary" style="float:right;display:none;" id="loading-images{{$i}}">saving </button> 
        <button type="submit" class="copy-text btn btn-inverse-secondary" style="float:right;display:none;" id="loading-image2s{{$i}}">saved </button>&nbsp;&nbsp;&nbsp;&nbsp;
        <a style="float:right !important" href="{{url('storage/app/public/images')}}/{{$html['name'][$j]}}"  class="btn btn-primary" download="{{$html['name'][$j]}}"> <i class="fa-solid fa-download"></i>&nbsp;&nbsp;&nbsp;&nbsp;
        </a>&nbsp;
        </div>
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
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn-submitss{{$i}}").click(function(e) {

            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
             $('#get_btns{{$i}}').hide();
            $('#loading-images{{$i}}').show();
            
            $.ajax({

                type: "POST",
                url: '<?php echo e(route('save_image')); ?>',
                data: $('#imforme{{$i}}').serializeArray(),
                success: function(data) {
                    $('#get_btns{{$i}}').hide();
                    $('#loading-images{{$i}}').hide();
                    $('#loading-image2s{{$i}}').show();
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
	<?php $j=0; ?>

        </div>
        <div class="col-xl-8 col-md-8 col-lg-8 col-sm-12 col-xs-12 align-items-stretch">
          <div class="card w-100">
                 <div class="card-header" style="min-height: 50px;">
	 <div class="card-title">
		
		<div class="row w-100" style="float:right !important;flex-direction: row-reverse !important;"><div class="button-group w-100 d-flex" style="float:right !important;flex-direction: row-reverse !important;"><div id="articlelike{{$j}}"></div></div></div> <div class="row w-100" id="get-articlebtnnnn{{$j}}"  style="float:right !important;flex-direction: row-reverse !important;"><div class="button-group w-100 d-flex" style="float:right !important;flex-direction: row-reverse !important;">
		
		<form id="articledislikeforms{{$j}}" method="post">
			@csrf 
			<input type="hidden" name="jid" value="{{$j}}">
			<input type="hidden" name="id" value="{{$html['article_history_id']}}">
			<button type="submit" class="btn btn-inverse-secondary btn-articledislikes{{$j}}" style="float:right;">
				<i class="fa fa-thumbs-o-down" aria-hidden="true"></i> </button>
		</form> 
		
		&nbsp; &nbsp;<form id="articlelikeform{{$j}}" method="post">@csrf 
		 
		 <input type="hidden" name="jid" value="{{$j}}">
		<input type="hidden" name="id" value="{{$html['article_history_id']}}"><button type="submit" class="btn btn-inverse-secondary btn-articlelike{{$j}}" style="float:right;"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> </button></form>
		
		</div></div>
	 </div></div>
              <div class="card-body">
               <form method="post" id="newform1">
             @csrf
                
                 <div class="d-flex">
                <h4 class="card-title w-100">Article</h4>
                <div  style="float:right !important">
                      <div class="col-12 d-flex">
                         <div class="d-flex w-100">
                            <div id="saveds"></div>
                <input type="text" class="form-control" name="project_id" placeholder="Project Name" required id="input_text"> &nbsp; <button type="submit" class="btn btn-outline-success btn-submit12i" id="save_button1"  style="float:right !important">Save</button> 
                &nbsp; <button id="loading-image22" class="btn btn-primary" type="button" disabled style="display: none">
                                              <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                              Saving...
                                            </button> 
                </div>

            
            </div></div></div><br>
            <?php $k=1; ?>
             @foreach($html['article']->choices as $comm)
             <?php
             if($open_ai_model=="chatGPT"){
                $check1=$comm->message->content;
                $checke1=str_replace("\n\n",'<br><br>',$check1);
                $checke2=str_replace("\n",'<br>',$checke1);
                }else{
                  $check1=$comm->text;  
                  $checke1=str_replace("\n\n",'<br><br>',$check1);
                   $checke2=str_replace("\n",'<br>',$checke1);
                }
              ?>
                <input type="hidden" value="{{$checke2}}" name="template">
                <p>{!! $checke2 !!}</p>

             <input type="hidden" name="tem_id"  value="{{$html['template_id']}}">
             
            
			
             @endforeach
             
               
   
       <div class="card-footer">
            <p style="float:right" class="text-muted">total words used : {{$html['article']->usage->total_tokens}}</p>
        </div>
           </form>

          </div>
               
         </div>
        
        </div>
       

         
        </div>


    </div> </div>
       

         
        </div>


    </div>

       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn-articlelike{{$j}}").click(function(e) {

            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
             

            $.ajax({

                type: "POST",
                url: '<?php echo e(route('articlelike')); ?>',
                data: $('#articlelikeform{{$j}}').serializeArray(),
                success: function(data) {
                  $('#articlelike{{$j}}').html(data);
                    $('#get-articlebtnnnn{{$j}}').hide();
                    
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

        $(".btn-articledislikes{{$j}}").click(function(e) {

            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
             

            $.ajax({

                type: "POST",
                url: '<?php echo e(route('articledislike')); ?>',
                data: $('#articledislikeforms{{$j}}').serializeArray(),
                success: function(data) {
                  $('#articlelike{{$j}}').html(data);
                    $('#get-articlebtnnnn{{$j}}').hide();
                    
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

        $(".btn-submit12i").click(function(e) {

            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });


            $('#loading-image22').show();
            $.ajax({

                type: "POST",
                url: '<?php echo e(route('save_project')); ?>',
                data: $('#newform1').serializeArray(),
                success: function(data) {
                    $('#save_button1').hide();
                    $('#saveds').html(data);
                    $('#loading-image22').hide();
                    $('#save_button').hide();
                     $('#input_text').hide();

                }
            });
        });


    </script>

       
