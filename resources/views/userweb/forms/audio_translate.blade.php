<div class="card">
	<div class="card-header">
	<div class="card-title"> Translated Results  <button class="copy-text btn btn-inverse-secondary" id="btn1" onclick="copyText1()" style="float:right;">Copy </button></div>
		</div>
	<div class="card-body">
 @php($open_ai_model=\App\Models\Setting::where('name','open_ai_model')->first()->value)


<p>

	   <form method="post" id="newformtra">
             @csrf
            <div class="card-body">
                 <div class="row w-100" id="savedtra"></div><br>
                <div id="save_button" class="row w-100">
                    <div class="d-flex w-100">
                <input type="text" class="form-control" name="project_id" placeholder="Project Name" required> &nbsp; <button type="submit" class="btn btn-outline-success btn-submittra"  style="float:right !important">Save</button>  
                </div></div>
                          
                &nbsp; <button id="loading-imagetra" class="btn btn-primary" type="button" disabled style="display: none">
                                              <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                              Saving...
                                            </button>
              
             
              <textarea id="text1"  name="template" id="summernote" style="height: calc(50vh - 58px) !important;" rows="100">{!! $html->text !!}</textarea>
               <input type="hidden" name="tem_id"  value="0">
             
            
            </div>
           </form>
 

</div><br>
<script>
	function copyText1(){
  const text = document.getElementById('text1').innerText
  const btnText = document.getElementById('btn1')
  navigator.clipboard.writeText(text);
  btnText.innerText = "Copied Text"
   }
</script>

     <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn-submittra").click(function(e) {

            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });


            $('#loading-imagetra').show();
            $.ajax({

                type: "POST",
                url: '<?php echo e(route('save_project')); ?>',
                data: $('#newformtra').serializeArray(),
                success: function(data) {
                    $('#save_buttontra').hide();
                    $('#savedtra').html(data);
                    $('#loading-image1tra').hide();
                    $('#save_buttontra').hide();

                }
            });
        });

        function showEditor() {
            var editor = CKEDITOR.instances['description'];
            if (editor) {
                editor.destroy(true);
            }
            CKEDITOR.replace('description');
            var editor = CKEDITOR.instances['description'];
        }
    </script>
	</div>
<!-- <div class="card-footer">
	<p style="float:right" class="text-muted">total words used : </p>
</div> -->
</div>