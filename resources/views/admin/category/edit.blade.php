@extends('admin.layout.app')

@section('content')

			<div class="row">
					
						<div class="card">
                               <div class="card-header">
                                 <h6 class="mb-0 text-uppercase">Edit Category</h6>
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
                                
                                 @php($tokenval=\App\Models\Setting::where('name','per_token')->first()->value);
								<div class="p-4 border rounded">
									<form class="row g-3 needs-validation" novalidate action="{{route('admin.category.update', $category->id)}}" method="post" enctype='multipart/form-data'>
										@csrf
										<div class="col-md-6">
											  <div class="d-flex">
											<label for="validationCustom01" class="form-label">Category Name </label></div>
											<input type="text" class="form-control" name="name" placeholder="Category Name" value="{{$category->name}}" required>

										</div>
                                      
                                        <div class="col-md-6">
											<label for="validationCustom01" class="form-label">Icon</label>
											<input type="file" class="form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" name="image" required style="padding: 6px;border-radius: 6px;border: 1px solid #c9c8c8;">
										</div>
										
			
										<div class="col-12">
											<button class="btn btn-primary" type="submit">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					
				</div>


@endsection