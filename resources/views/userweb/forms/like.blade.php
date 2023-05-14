<?php $j=$html->j_id; ?>

<div class="button-group w-100 d-flex" style="float:right !important;flex-direction: row-reverse !important;"><form id="dislikeform{{$j}}" method="post">@csrf <input type="hidden" name="jid" value="{{$j}}"><input type="hidden" name="id" value="{{$html->id}}">@if($html->like_dislike==2) <button class="copy-text btn btn-inverse-secondary" style="float:right;" disabled><i class="fa fa-thumbs-down" aria-hidden="true"></i> </button> @else<button type="submit" class="copy-text btn btn-inverse-secondary btn-dislike{{$j}}" style="float:right;"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> </button>@endif</form> &nbsp; &nbsp;<form id="likeform{{$j}}" method="post">@csrf <input type="hidden" name="jid" value="{{$j}}"><input type="hidden" name="id" value="{{$html->id}}">@if($html->like_dislike==1) <button class="copy-text btn btn-inverse-secondary" style="float:right;" disabled><i class="fa fa-thumbs-up" aria-hidden="true"></i> </button> @else<button type="submit" class="copy-text btn btn-inverse-secondary btn-like{{$j}}" style="float:right;"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> </button>@endif</form></div>




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

        $(".btn-dislike{{$j}}").click(function(e) {

            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
             

            $.ajax({

                type: "POST",
                url: '<?php echo e(route('dislike')); ?>',
                data: $('#dislikeform{{$j}}').serializeArray(),
                success: function(data) {
                  $('#like{{$j}}').html(data);
                    $('#get-btnnnn{{$j}}').hide();
                    
                }
            });





        });
    </script>