
@extends('admin.layout.app')
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js'></script>
<style>
 .switch {
  position: relative;
  display: block;
  vertical-align: top;
  width: 100px;
  height: 30px;
  padding: 3px;
  margin: 0 10px 10px 0;
  background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
  background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
  border-radius: 18px;
  box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
  cursor: pointer;
}
.switch-input {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}
.switch-label {
  position: relative;
  display: block;
  height: inherit;
  font-size: 10px;
  text-transform: uppercase;
  background: #eceeef;
  border-radius: inherit;
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
}
.switch-label:before, .switch-label:after {
  position: absolute;
  top: 50%;
  margin-top: -.5em;
  line-height: 1;
  -webkit-transition: inherit;
  -moz-transition: inherit;
  -o-transition: inherit;
  transition: inherit;
}
.switch-label:before {
  content: attr(data-off);
  right: 11px;
  font-weight:500;
  color: white;
  text-shadow: 0 1px rgba(255, 255, 255, 0.5);
}
.switch-label:after {
  content: attr(data-on);
  left: 11px;
  color: #FFFFFF;
  font-weight:500;
  text-shadow: 0 1px rgba(0, 0, 0, 0.2);
  opacity: 0;
}
.switch-input:checked ~ .switch-label {
  background: #0088cc;
  border-color: #0088cc;
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
}
.switch-input:checked ~ .switch-label:before {
  opacity: 0;
}
.switch-input:checked ~ .switch-label:after {
  opacity: 1;
}
.switch-handle {
  position: absolute;
  top: 4px;
  left: 4px;
  width: 28px;
  height: 28px;
  background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
  background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
  border-radius: 100%;
  box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
}
.switch-handle:before {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -6px 0 0 -6px;
  width: 12px;
  height: 12px;
  background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
  background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
  border-radius: 6px;
  box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
}
.switch-input:checked ~ .switch-handle {
  left: 74px;
  box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
}

/* Transition
========================== */
.switch-label, .switch-handle {
  transition: All 0.3s ease;
  -webkit-transition: All 0.3s ease;
  -moz-transition: All 0.3s ease;
  -o-transition: All 0.3s ease;
}
span.switch-label {
    background: green;
}
	
	.switch-input:checked ~ .switch-handle {
  left: 115px !important;
}
	
	.switch {
       width: 150px !important;
	}
</style>
@section('content')
			<div class="row">
						
						<div class="card">
                            <div class="card-header">
                                 <h6 class="mb-0 text-uppercase">Settings</h6>
                            </div>
							<div class="card-body">
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
                                @php($name=\App\Models\Setting::where('name','app_name')->first()->value)
                                @php($logo=\App\Models\Setting::where('name','logo')->first()->value)
                                 @php($favicon=\App\Models\Setting::where('name','favicon')->first()->value)
                                 @php($footer_logo=\App\Models\Setting::where('name','footer_logo')->first()->value)
                                @php($currency_name=\App\Models\Setting::where('name','currency_name')->first()->value)
                                @php($currency_symbol=\App\Models\Setting::where('name','currency_symbol')->first()->value)
                                 @php($openai=\App\Models\Setting::where('name','open_ai')->first()->value)
                                 @php($words_per_image=\App\Models\Setting::where('name','words_per_image')->first()->value)
                                 @php($open_ai_model=\App\Models\Setting::where('name','open_ai_model')->first()->value)
                                 @php($footer_text1=\App\Models\Setting::where('name','footer_text1')->first()->value)
                                  @php($footer_text2=\App\Models\Setting::where('name','footer_text2')->first()->value)
                                  @php($facebook=\App\Models\Setting::where('name','facebook')->first()->value)
                                  @php($twitter=\App\Models\Setting::where('name','twitter')->first()->value)
                                  @php($google=\App\Models\Setting::where('name','google')->first()->value)
                                  @php($btncolor=\App\Models\Setting::where('name','btncolor')->first()->value)
                                  @php($image=\DB::table('image_spaces')->first())
								 @php($deepai=\App\Models\Setting::where('name','deep_ai')->first()->value)
								
								@php($image_model=\App\Models\Setting::where('name','image_model')->first()->value)
								<div class="p-4 border rounded">
									<form class="row g-3 needs-validation" novalidate action="{{route('admin.settings.update')}}" method="post" enctype='multipart/form-data'>
										@csrf
										<div class="col-md-4 col-xs-12 col-sm-12">
											<label for="validationCustom01" class="form-label">App Name </label>
											<input type="text" class="form-control" id="validationCustom01" name="app_name" placeholder="App Name" value="{{$name}}" required>
											
										</div>

										
                                       
                                        <div class="col-md-4 col-xs-12 col-sm-12">
											<label for="validationCustom01" class="form-label">Currency Name</label>
											<input type="text" class="form-control" id="validationCustom01" name="currency_name" placeholder="Currency Name" value="{{$currency_name}}"  required>
											
										</div>
                                        <div class="col-md-4 col-xs-12 col-sm-12">
											<label for="validationCustom01" class="form-label">Currency Symbol</label>
											<input type="text" class="form-control" id="validationCustom01" name="currency_symbol" placeholder="Currency Symbol" value="{{$currency_symbol}}" required>
											
										</div>
										
                                        
                                        
                    <div class="col-md-4 col-xs-12 col-sm-12">
                     
											<label for="validationCustom01" class="form-label">Main Logo </label>
                                            <input class="form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" type="file" id="formFile" name="logo" style="padding: 6px; border-radius: 6px; border: 1px solid #c9c8c8;">
											
										</div> 

                    <div class="col-md-4 col-xs-12 col-sm-12">
                    
                      <label for="validationCustom01" class="form-label">Website Footer Logo </label>
                                            <input class="form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" type="file" id="formFile" name="footer_logo" style="padding: 6px; border-radius: 6px; border: 1px solid #c9c8c8;">
                      
                    </div>
                       <div class="col-md-4 col-xs-12 col-sm-12">
                       
											<label for="validationCustom01" class="form-label" >Favicon </label>
                                            <input class="form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" type="file" id="formFile" name="favicon" style="padding: 6px; border-radius: 6px; border: 1px solid #c9c8c8;">
											
										</div>

										 <div class="col-md-4 col-xs-12 col-sm-12">
											<label for="validationCustom01" class="form-label">Open AI API </label>
                                            <input class="form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" type="text" id="formFile" style="padding: 6px; border-radius: 6px; border: 1px solid #c9c8c8;" name="open_ai" value="{{$openai}}">
										</div>
										
										<div class="col-md-4 col-xs-12 col-sm-12">
											<label for="validationCustom01" class="form-label">Stable Diffusion API(for Images) </label>
                                            <input class="form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" type="text" id="formFile" style="padding: 6px; border-radius: 6px; border: 1px solid #c9c8c8;" name="deep_ai" value="{{$deepai}}">
										</div>
										<div class="col-md-4 col-xs-12 col-sm-12">
											<label for="validationCustom01" class="form-label">Words per Image <span style="color:red">*</span> </label>
											<input type="number" class="form-control" id="validationCustom01" name="words_per_image" placeholder="How many words will be deducted on per image generation?" value="{{$words_per_image}}" required>
											
										</div>
                    <div class="col-md-4 col-xs-12 col-sm-12">
                      <label for="validationCustom01" class="form-label">Left Footer Text<span style="color:red">*</span> </label>
                      <input type="text" class="form-control" id="footer" name="footer_text1" placeholder="Copyright @2023" value="{{$footer_text1}}" required>
                      
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-12">
                      <label for="validationCustom01" class="form-label">Right Footer Text<span style="color:red">*</span> </label>
                      <input type="text" class="form-control" id="footer" name="footer_text2" placeholder="Handcrafted with love" value="{{$footer_text2}}" required>
                      
                    </div>
										<div class="col-md-2 col-xs-12 col-sm-12">
											<label for="validationCustom01" class="form-label">Open AI Model &nbsp;&nbsp;<a href="#" data-toggle="tooltip" 
    title="for chat feature, ChatGPT model will be used">
    <img src="{{url('assets/images/info.png')}}" alt="info" style="width:20px;max-height:20px;float:right">
</a> </label>
											 <div class="jumbotron bg-white">
											 
											    	<label class="switch ">
											  <input class="switch-input" name="gpt" type="checkbox" @if($open_ai_model=="chatGPT") checked @endif />
											  <span class="switch-label" data-on="ChatGPT" data-off="Davinci"></span> 
											  <span class="switch-handle"></span> 
											 </label>
											     
											  </div>

											  
										</div>
										<div class="col-md-2 col-xs-12 col-sm-12">
											<label for="validationCustom01" class="form-label">Image Model &nbsp;&nbsp;<a href="#" data-toggle="tooltip" 
    title="for Image Generation you can use openAI dall model or DeepAI stable diffusion">
    <img src="{{url('assets/images/info.png')}}" alt="info" style="width:20px;max-height:20px;float:right">
</a> </label>
											 <div class="jumbotron bg-white">
											 
											    	<label class="switch ">
											  <input class="switch-input" name="image_model" type="checkbox" @if($image_model=="dall") checked @endif />
											  <span class="switch-label" data-on="Dall(openAI)" data-off="Stable Diffusion"></span> 
											  <span class="switch-handle"></span> 
											 </label>
											     
											  </div>

											  
										</div>

                    <div class="col-md-4 col-xs-12 col-sm-12">
                      <label for="validationCustom01" class="form-label">{{ __('lang.btncolor')}} <span style="color:red">*</span> </label>
                      <input type="color" class="form-control" id="btncolor" name="btncolor"  value="{{$btncolor}}" required>
                      
          </div>
                    <div class="col-md-4 col-xs-12 col-sm-12">
                      <label for="validationCustom01" class="form-label"> Select Storage Space</label>
                      <select class="form-control" name="imagespace_status">
                        <option value="same_server" @if($image->same_server==1) selected @endif>Same Server</option>
                        <option value="wasabi" @if($image->wasabi==1) selected @endif>Wasabi</option>
                        <option value="aws" @if($image->aws==1) selected @endif>AWS</option>
                      </select>

                    </div>

                   

                   <br>
                    <hr>
                    <h4>Social Links </h4>

                      <div class="col-md-4 col-xs-12 col-sm-12">
                      <label for="validationCustom01" class="form-label">Facebook </label>
                      <input type="text" class="form-control" id="validationCustom01" name="facebook" placeholder="Facebook Link" value="{{$facebook}}" required>
                      
                    </div>


                      <div class="col-md-4 col-xs-12 col-sm-12">
                      <label for="validationCustom01" class="form-label">Twitter </label>
                      <input type="text" class="form-control" id="validationCustom01" name="twitter" placeholder="Twitter Link" value="{{$twitter}}" required>
                      
                    </div>

                      <div class="col-md-4 col-xs-12 col-sm-12">
                      <label for="validationCustom01" class="form-label">Google </label>
                      <input type="text" class="form-control" id="validationCustom01" name="google" placeholder="Google Link" value="{{$google}}" required>
                      
                    </div>
			
										<div class="col-12">
											<button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="submit">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

<script>
(function() {
  $(document).ready(function() {
    $('.switch-input').on('change', function() {
      var isChecked = $(this).is(':checked');
      var selectedData;
      var $switchLabel = $('.switch-label');
      console.log('isChecked: ' + isChecked); 

      if(isChecked) {
        selectedData = $switchLabel.attr('data-on');
      } else {
        selectedData = $switchLabel.attr('data-off');
      }

      console.log('Selected data: ' + selectedData);

    });
  });

})();
</script>

@endsection