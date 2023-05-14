
@extends('admin.layout.app')

@section('content')

			<div class="row">
					
						<div class="card">
                               <div class="card-header">
                                 <h6 class="mb-0 text-uppercase">Edit Membership Details</h6>
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
									<form class="row g-3 needs-validation" novalidate action="{{route('admin.membership.details.update', $membership->id)}}" method="post">
								    @csrf
										<div class="col-md-4">
                          
											<label for="validationCustom01" class="form-label">Type </label>
											<input type="text" class="form-control" id="validationCustom01" name="name" placeholder="type" value="{{$membership->type}}" required>
											
										</div>
										 @if($membership->mem_id != 1)
                                        <div class="col-md-4">
											<label for="validationCustom01" class="form-label">Discount</label>
											<input type="number" class="form-control" id="validationCustom01" name="discount" placeholder="discount" value="{{$membership->discount}}"  required>
										
										</div>
										
                                        <div class="col-md-4">
											<label for="validationCustom01" class="form-label">Validity @if($membership->mem_id == 1) Days @else Months @endif</label>
											
											<input type="number" class="form-control" id="validationCustom01" name="validity" placeholder="Validity @if($membership->mem_id == 1) Days @else Months @endif"  @if($membership->mem_id == 1) value="{{$membership->days}}" @else value="{{$membership->months}}"  @endif required>
										</div>
										@endif
										<div class="col-12">
											<button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" type="submit">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					
				</div>


@endsection