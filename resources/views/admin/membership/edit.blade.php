
@extends('admin.layout.app')

@section('content')

			<div class="row">
					
						<div class="card">
                               <div class="card-header">
                                 <h6 class="mb-0 text-uppercase">Edit Membership Plan</h6>
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
									<form class="row g-3 needs-validation" novalidate action="{{route('admin.membership.update', $user->id)}}" method="post">
								    @csrf
										<div class="col-md-4">
                          
											<label for="validationCustom01" class="form-label">Name </label>
											<input type="text" class="form-control" id="validationCustom01" name="name" placeholder="Membership" value="{{$user->name}}" required>
											
										</div>
										@php($open_ai_model=\App\Models\Setting::where('name','open_ai_model')->first()->value)
                                       @if($open_ai_model != "chatGPT")
										<div class="col-md-4">
											<label for="validationCustom01" class="form-label">Select {{$open_ai_model}} Model</label>
											<select name="model_sel" class="form-control" required>
												<option value="text-davinci-003" @if($user->model == "text-davinci-003") selected @endif>Davinci (Most Powerful)</option>
												<option value="text-curie-001" @if($user->model == "text-curie-001") selected @endif>Curie</option>
												<option value="text-babbage-001" @if($user->model == "text-babbage-001") selected @endif>Babbage</option>
												<option value="text-ada-001" @if($user->model == "text-ada-003") selected @endif>Ada (Fastest)</option>
											</select>
											
										</div>
										@else
										<div class="col-md-4">
											<label for="validationCustom01" class="form-label">Select {{$open_ai_model}} Model</label>
											<select name="model_sel" class="form-control" required>
												<option value="gpt-3.5-turbo" @if($user->model == "gpt-3.5-turbo") selected @endif>ChatGPT</option>
											</select>
										</div>
										@endif

										
                                        <div class="col-md-4">
											<label for="validationCustom01" class="form-label">Tokens</label>
											<input type="number" class="form-control" id="validationCustom01" name="tokens" placeholder="Tokens" value="{{$user->tokens}}"  required>
										
										</div>
										 <div class="col-md-4">
											<label for="validationCustom01" class="form-label">Speech To Text Minutes(in minutes)</label>
											<input type="number" class="form-control" id="validationCustom01" name="speech_minutes" placeholder="Speech to Text audio length" value="{{$user->speech_minutes }}"  required>
										
										</div>
										<div class="col-md-4">
											<label for="validationCustom01" class="form-label">Article Generation</label>
											<select name="article" class="form-control" required>
                                                <option value="1">Enable</option>
                                                <option value="0">Disable</option>
											</select>
										
										</div>
										<div class="col-md-4">
											<label for="validationCustom01" class="form-label">Image Generation</label>
											<select name="image" class="form-control" required>
                                                <option value="1">Enable</option>
                                                <option value="0">Disable</option>
											</select>
										
										</div>

										<div class="col-md-4">
											<label for="validationCustom01" class="form-label">Team limit</label>
											<input type="number" class="form-control" id="validationCustom01" name="team_limit" placeholder="Team Member Limit"  value="{{$user->team_limit}}"  @if($user->id == 1) readonly disabled @endif required>
											
										</div>
                                        <div class="col-md-4">
											<label for="validationCustom01" class="form-label">Folder limit</label>
											<input type="number" class="form-control" id="validationCustom01" name="folder_limit" placeholder="Folder Limit"  value="{{$user->folder_limit}}" required>
											
										</div>
                                        
                                         <div class="col-md-4">
											<label for="validationCustom01" class="form-label">Project Limit</label>
											<input type="number" class="form-control" id="validationCustom01" name="project_limit" placeholder="Project Limit." value="{{$user->project_limit}}" >
											
										</div>
										
                                          <div class="col-md-4">
											<label for="validationCustom01" class="form-label">Price</label>
											<input type="number" class="form-control" id="validationCustom01" name="price" placeholder="Plan price "  value="{{$user->price}}"  @if($user->id == 1) readonly disabled @endif>
											
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