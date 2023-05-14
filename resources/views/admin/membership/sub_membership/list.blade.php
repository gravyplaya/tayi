
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
                                 <h6 class="mb-0 text-uppercase">Membership Details</h6>
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
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Type</th>
										<th>tokens</th>
										<th>discount</th>
										<th>folder limit</th>
										<th>project limit</th>
										<th>Validity</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; ?>
									@foreach($membership as $cat)
									<tr>
										<td>{{$i}}</td>
										<td>{{$cat->type}}</td>
										<td>{{$cat->mem->tokens * $cat->months}}</td>
                                        <td>{{$cat->discount}} %</td>
										<td>@if($cat->mem->folder_limit >0 && $cat->months > 0) {{$cat->mem->folder_limit * $cat->months}} @elseif($cat->mem->folder_limit >0 && $cat->months == NULL) {{$cat->mem->folder_limit}} @else <span style="color:green">Unlimited</span>@endif</td>
										<td>@if($cat->mem->project_limit >0 && $cat->months > 0){{$cat->mem->project_limit * $cat->months}} @elseif($cat->mem->project_limit >0 && $cat->months == NULL) {{$cat->mem->project_limit}} @else <span style="color:green">Unlimited</span>@endif</td>
										<td>@if($cat->months != NULL) {{$cat->months }} Months @endif  @if($cat->days != NULL) {{$cat->days }} Days @endif</td>
										<td><div class="col">
										<div class="dropdown">
											<button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item" href="{{route('admin.membership.details.edit',$cat->id)}}">Edit</a>
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