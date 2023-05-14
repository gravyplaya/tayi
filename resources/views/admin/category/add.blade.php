
@extends('admin.layout.app')
@section('content')
			<div class="row">
						
						<div class="card">
                            <div class="card-header">
                                 <h6 class="mb-0 text-uppercase">Add Category</h6>
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
									<form class="row g-3 needs-validation" novalidate action="{{route('admin.category.store')}}" method="post" enctype='multipart/form-data'>
										@csrf
										<div class="row">
										<div class="col-md-6">
                                            <div class="d-flex">
											<label for="validationCustom01" class="form-label">Category Name</label></div>
											<input type="text" class="form-control" id="validationCustom01" name="name" placeholder="Category Name" required>
										</div>
                                     
                                      
										 <div class="col-md-6">
											<label for="validationCustom01" class="form-label">Icon</label>
											<input type="file" class="form-control form-control" name="image" required style="padding: 6px;border-radius: 6px;border: 1px solid #c9c8c8;">
										</div>
									</div><hr>

								      
			
										<div class="col-12">
											<button class="btn btn-success" type="submit">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>




@endsection