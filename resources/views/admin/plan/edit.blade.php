
@extends('admin.layout.app')

@section('content')
			<div class="row">
					
						<div class="card">
                               <div class="card-header">
                                 <h6 class="mb-0 text-uppercase">Edit Word Top-Up Plan</h6>
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
                                  @php($currency=\App\Models\Setting::where('name','currency_symbol')->first()->value)
								<div class="p-4 border rounded">
									<form class="row g-3 needs-validation" novalidate action="{{route('admin.plan.update', $plan->id)}}" method="post">
										@csrf
										<div class="col-md-4">
											  <div class="d-flex">
											<label for="validationCustom01" class="form-label">Words </label></div>
											<input type="number" class="form-control" id="validationCustom01" name="tokens" placeholder="No. Of words" value="{{$plan->tokens}}" required>
											
										</div>
                                      
                                        <div class="col-md-4">
											<label for="validationCustom01" class="form-label">Price ({{$currency}})</label>
											<div class="d-flex">
											 <input type="number" class="form-control" id="validationCustom01" name="price" placeholder="Price of words" value="{{$plan->price}}" required>
											 </div>
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