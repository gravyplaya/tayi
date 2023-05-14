
@extends('admin.layout.app')
@section('content')
			<div class="row">
						
						<div class="card">
                            <div class="card-header">
                                 <h6 class="mb-0 text-uppercase">Add Prompt</h6>
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
                                 
								<div class="p-4 border rounded">
									<form class="row g-3 needs-validation" novalidate action="{{route('admin.template.store')}}" method="post" enctype='multipart/form-data'>
										@csrf
										<div class="row">
										<div class="col-md-4">
                                            <div class="d-flex">
											<label for="validationCustom01" class="form-label">Name Of the Prompt</label></div>
											<input type="text" class="form-control" id="validationCustom01" name="name" placeholder="Prompt Name" required>
										</div>
                                        <div class="col-md-4">
											<label for="validationCustom01" class="form-label">Description</label>
											<input type="text" class="form-control" id="validationCustom01" name="description" placeholder="Prompt Description" required>
										</div>

										 <div class="col-md-4">
											<label for="validationCustom01" class="form-label">select category</label>
											@php($category=\App\Models\Category::get());
											<select name="category" class="form-control" required>
												@foreach($category as $cat)
												<option value="{{$cat->id}}">{{$cat->name}}</option>
												@endforeach
											</select>

										</div>
										<br>
									</div>
									<br>
									<div class="row mt-3 mb-3">
										 <div class="col-md-4">
											<label for="validationCustom01" class="form-label">Icon</label>
											<input type="file" class="form-control form-control" name="image" required style="padding: 6px;border-radius: 6px;border: 1px solid #c9c8c8;">
										</div>
										<div class="col-md-4">
											<label for="validationCustom01" class="form-label">Tone Field*</label>
											<select name="tone" class="form-control" required>
												 <option value="0" > Active</option>
												 <option value="1" > Deactive</option>
											</select>
										   
										</div>
										<div class="col-md-4">
											<label for="validationCustom01" class="form-label">Variant Field*</label>
											<select name="variant" class="form-control" required>
												 <option value="0" > Active</option>
												 <option value="1" > Deactive</option>
											</select>
										   
										</div>
										<div class="col-md-4">
											<label for="validationCustom01" class="form-label">System Message</label>
											<textarea name="system_message" class="form-control" placeholder="You are a helpful Assistant" required></textarea>
										</div>
									</div>

                                  	<div class="card">
									<div class="card-header">
									<h3 align="center">Dynamic Fields For User Panel</h3></div>
                                    <div class="card-body">
								      
                                       <div class="row">
										<div class="col-md-4">
                                            <div class="d-flex">
											<label for="validationCustom01" class="form-label">Field-1 Name</label></div>
											<input type="text" class="form-control" id="validationCustom01" name="moreFields[0][title]" placeholder="Field Name" required>
										</div>


										<div class="col-md-4">
                                            <div class="d-flex">
											<label for="validationCustom01" class="form-label">Field-1 Placeholder</label></div>
											<input type="text" class="form-control" id="validationCustom01" name="moreFields[0][description]" placeholder="Field placeholder" required>
										</div>

                                        <div class="col-md-3">
											<label for="validationCustom01" class="form-label">Field-1 Type</label>
											<select name="moreFields[0][type]" class="form-control" required>
												 <option value="text"> Text Field</option>
												 <option value="textarea"> Text Area Field</option>
											</select>
										   
										</div>
										 <div class="col-md-1 p-2">
										 	 
										 	  	<label for="validationCustom01" class="form-label"></label><br>
												<button type="button" name="add" id="add-btn" class="btn btn-primary">+</button>
									          
									     </div>
										
									</div>
									<div id="dynamicAddRemove"></div>
                                      
									    <div class="col-md-12">
                                          <div id="field"></div>
                                            <div class="d-flex">

											<label for="validationCustom01" class="form-label">Custom prompt</label></div>
											<textarea name="prompt" class="form-control" placeholder="ex:write an essay on #field-1# and focus keywords will be #field-2#" required></textarea>
											
										</div>
									</div></div>
			
										<div class="col-12">
											<button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="submit">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>

<script type="text/javascript">
var i = 0;
var k=1;

$("#add-btn").click(function(){
++i;
++k;
$("#dynamicAddRemove").append('<div class="row"><tr><td><div class="col-md-4"><div class="d-flex"><label for="validationCustom01" class="form-label">Field-'+k+' Name</label></div><input type="text" class="form-control" id="validationCustom01" name="moreFields['+i+'][title]" placeholder="Field-'+k+' Name" required></div><div class="col-md-4"><div class="d-flex"><label for="validationCustom01" class="form-label">Field-'+k+' Placeholder</label></div><input type="text" class="form-control" id="validationCustom01" name="moreFields['+i+'][description]" placeholder="Field-'+k+' Placeholder" required></div><div class="col-md-3"><label for="validationCustom01" class="form-label">Field-'+k+' Type</label><select name="moreFields['+i+'][type]" class="form-control"><option value="text"> Text Field</option><option value="textarea"> Text Area Field</option></select><br></div><br>');
});

$(document).on('click', '.remove-tr', function(){  
$(this).parents('tr').remove();
});  
</script>



@endsection