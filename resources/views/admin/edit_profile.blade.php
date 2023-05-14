@extends('admin.layout.app')

@section('content')


<div class="container">

<div class="col-md-12 grid-margin stretch-card">
						<div class="card">
							<div class="card-header">
							<h6 class="card-title">Edit Admin Profile</h6>
							</div>
							<div class="card-body">

								<form class="forms-sample" action="{{route('admin.update-admins-profile')}}" method="post"  enctype="multipart/form-data">
									@csrf
										<div class="row mb-3">
										<label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
										<div class="col-sm-9">
											<input type="email" name="email" class="form-control" id="exampleInputEmail2" autocomplete="off" placeholder="Email" value="{{auth('admin')->user()->email}}">
										</div>
									</div>
									
									<div class="row mb-3">
										<label for="exampleInputUsername2" class="col-sm-3 col-form-label">Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="name" id="exampleInputUsername2" placeholder="Name" value="{{auth('admin')->user()->name}}">
										</div>
									</div>
									
								
									<div class="row mb-3">
										<label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
										<div class="col-sm-9">
											<input type="password" class="form-control" id="exampleInputPassword2" name="password" autocomplete="off" placeholder="Insert password if you want to change">
										</div>
									</div>
									<img src="{{$url_aws}}user/{{auth('admin')->user()->image}}" alt="image" style="width:100px; max-height:100px;">
									<div class="row mb-3">
										
										<label for="exampleInputUsername2" class="col-sm-3 col-form-label">Profile Image</label>
										<div class="col-sm-9">
											<input class="form-control" type="file" name="image" id="formFile">
										</div>
									</div>
									<button type="submit" class="btn btn-primary me-2">Submit</button>
									<button class="btn btn-secondary">Cancel</button>
								</form>

							</div>
						</div>
					</div>
	
</div>

@endsection