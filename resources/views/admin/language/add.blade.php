
@extends('admin.layout.app')

@section('content')

			<div class="row">
						
						<div class="card">
                            <div class="card-header">
                                 <h6 class="mb-0 text-uppercase">Add Language</h6>
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
									<form class="row g-3 needs-validation" novalidate action="{{route('admin.language.store')}}" method="post">
										@csrf
										<div class="col-md-4">
                                            <div class="d-flex">
											<label for="validationCustom01" class="form-label">Language name </label> </div>
											<input type="text" class="form-control" id="validationCustom01" name="name" placeholder="e.g. hindi" required>
										</div>
                                        <div class="col-md-4">
											<label for="validationCustom01" class="form-label">flag</label>
											<input type="text" class="form-control" id="validationCustom01" name="flag" placeholder="Insert Flag icon" required>
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