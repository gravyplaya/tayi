
@extends('admin.layout.app')

@section('content')

<style>
	#example2_filter {
  float: right;
  margin-bottom: 10px;
}
</style>
@php($currency=\App\Models\Setting::where('name','currency_symbol')->first()->value)
				<div class="card">
                      <div class="card-header">
                                 <h6 class="mb-0 text-uppercase">Words Top-Up Plans List</h6>
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
										<th>words</th>
										<th>Price($currency)</th>
										 <th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; ?>
									@foreach($plan as $cat)
									<tr>
										<td>{{$i}}</td>
										<td>{{$cat->tokens}}</td>
										<td>{{$cat->price}}</td>	
										<td><div class="col">
										<div class="dropdown">
											<button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item" href="{{route('admin.plan.edit',$cat->id)}}">Edit</a>
												</li>
												<li><a class="dropdown-item" href="{{route('admin.plan.delete',$cat->id)}}">Delete</a>
												</li>
												
											</ul>
										</div>
									</div></td>
									</tr>
									<?php $i++; ?>
									 @endforeach
								</tbody>
								<tfoot>
									
								</tfoot>
							</table>
						</div>
					</div>
				</div>


@endsection