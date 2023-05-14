
@extends('admin.layout.app')

@section('content')

			<div class="row">
						
						<div class="card">
                            <div class="card-header">
                                 <h6 class="mb-0 text-uppercase">Payment Gateway Settings</h6> 
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
                                @php($razorpay=\App\Models\PaymentGateway::where('name','razorpay')->first())
                                @php($stripe=\App\Models\PaymentGateway::where('name','stripe')->first())
                               
								<div class="p-4 border rounded">
									<form class="row g-3 needs-validation" novalidate action="{{route('admin.payment_gateway.update')}}" method="post" enctype='multipart/form-data'>
										@csrf
                                        <label for="validationCustom01" class="form-label"><b>Razorpay Settings</b></label>
										<div class="col-md-4">
											<label for="validationCustom01" class="form-label">Secret Key </label>
											<input type="text" class="form-control" id="validationCustom01" name="razorpay_secret" placeholder="Razorpay Secret" value="{{$razorpay->secret}}" required>
											<div class="valid-feedback">Looks good!</div>
											<div class="invalid-feedback">Please insert Razorpay Secret.</div>
										</div>
                                       
                                        <div class="col-md-4">
											<label for="validationCustom01" class="form-label">API key</label>
											<input type="text" class="form-control" id="validationCustom01" name="razorpay_api_key" placeholder="API Key" value="{{$razorpay->api_key}}"  required>
											<div class="valid-feedback">Looks good!</div>
											<div class="invalid-feedback">Please insert Razorpay API key.</div>
										</div>
                                        
                                        <div class="col-md-4">
											<label for="validationCustom01" class="form-label">Enable</label>
                                            <select class="form-control" name="razorpay_status" required>
                                                
                                               <option value="1" @if($razorpay->active==1)selected @endif>Yes</option>
                                                <option value="0" @if($razorpay->active==0)selected @endif>No</option>
                                            </select>
											
										</div>
                                        <br><br>
                                        <hr><br><br>
                                         <label for="validationCustom01" class="form-label"><b>Stripe Settings</b></label>
										<div class="col-md-4">
											<label for="validationCustom01" class="form-label">Secret Key </label>
											<input type="text" class="form-control" id="validationCustom01" name="stripe_secret" placeholder="Stripe Secret" value="{{$stripe->secret}}" required>
									
										</div>
                                       
                                        <div class="col-md-4">
											<label for="validationCustom01" class="form-label">Publishable API key</label>
											<input type="text"  class="form-control" id="validationCustom01" name="stripe_api_key" placeholder="Stripe Publishable API Key" value="{{$stripe->api_key}}"  required>
										
										</div>
                                        
                                        <div class="col-md-4">
											<label for="validationCustom01" class="form-label">Enable</label>
                                            <select class="form-control" name="stripe_status" required>
                                                
                                               <option value="1" @if($stripe->active==1)selected @endif>Yes</option>
                                                <option value="0" @if($stripe->active==0)selected @endif>No</option>
                                            </select>
											
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