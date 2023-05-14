@extends('admin.layout.app')

@section('content')

<style>
	#example2_filter {
  float: right;
  margin-bottom: 10px;
}
</style>

				<div class="card">
                      <div class="card-header">
                                 <h6 class="mb-0 text-uppercase">prompts List</h6>
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
						  <div class="table-responsive">
                         <table id="dataTableExample" class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Slug</th>
										<th>Description</th>
										<th>Icon</th>
										<th>Premium</th>
										<th>Highlighted</th>
										<th>Popular</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; ?>
									@foreach($template as $cat)
									<tr>
										<td>{{$i}}</td>
										<td>{{$cat->name}}</td>
										<td>{{$cat->slug}}</td>
										<td>{{ Str::limit($cat->description, 20) }}</td>
										<td><img src="{{$url_aws}}icon/{{$cat->icon}}" style="width:50px;height:50px"></td>	
										<td>@if($cat->premium==1) <a href="{{route('admin.template.premium',$cat->id)}}?status=0" class="btn btn-danger">Remove</a> @else <a href="{{route('admin.template.premium',$cat->id)}}?status=1" class="btn btn-success">Add </a> @endif</td>
										<td>@if($cat->highlighted==1) <a href="{{route('admin.template.highlighted',$cat->id)}}?status=0" class="btn btn-danger">Remove</a> @else <a href="{{route('admin.template.highlighted',$cat->id)}}?status=1" class="btn btn-success">Add </a> @endif</td>
										<td>@if($cat->popular==1) <a href="{{route('admin.template.popular',$cat->id)}}?status=0" class="btn btn-danger">Remove</a> @else <a href="{{route('admin.template.popular',$cat->id)}}?status=1" class="btn btn-success">Add </a> @endif</td>
										<td><div class="col">
										<div class="dropdown">
											<button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item" href="{{route('admin.template.edit',$cat->id)}}">Edit</a>
												</li>
												<li><a class="dropdown-item" href="{{route('admin.template.delete',$cat->id)}}">Delete</a>
												</li>
												
											</ul>
										</div>
									</div></td>
									</tr>
									<?php $i++; ?>
									 @endforeach
								</tbody>
								
							</table>
						</div>
					</div>
				</div>

@endsection