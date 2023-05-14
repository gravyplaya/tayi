@extends('admin.layout.app')

@section('content')

			<div class="row">
						
						<div class="card">
                            <div class="card-header">
                                 <h6 class="mb-0 text-uppercase">Add User</h6>
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
									<form class="row g-3 needs-validation" novalidate action="{{route('admin.user.store')}}" method="post">
										@csrf
										<div class="col-md-4">
                          
											<label for="validationCustom01" class="form-label">Name </label>
											<input type="text" class="form-control" id="validationCustom01" name="name" placeholder="User Name Ex: John" required>
											
										</div>
                                        <div class="col-md-4">
											<label for="validationCustom01" class="form-label">Email</label>
											<input type="email" class="form-control" id="validationCustom01" name="email" placeholder="User Email id Ex:-xyz@gmail.com" required>
										
										</div>
                                      
                                        
                                         <div class="col-md-4">
											<label for="validationCustom01" class="form-label">Password</label>
											<input type="text" class="form-control" id="validationCustom01" name="password" placeholder="password minimum 8 character long" required>
											
										</div>
                                         <div class="col-md-4">
											<label for="validationCustom01" class="form-label">User Profile Image </label>
                                            <input class="form-control form-control" type="file" id="formFile" name="image" style="padding: 6px; border-radius: 6px; border: 1px solid #c9c8c8;">
											
										</div>
										
			
										<div class="col-12">
											<button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="submit">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>


@endsection