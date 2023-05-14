
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
                                 <h6 class="mb-0 text-uppercase">User Transactions</h6>
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
										<th>Transaction For</th>
										<th>Amount</th>
										<th>User</th>
										<th>Transaction Date</th>
										<th>Transaction ID</th>
										<th>Medium</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; ?>
									@foreach($user as $cat)
									<tr>
										<td>{{$i}}</td>
										<td>@if($cat->sub_membershipp != NULL){{$cat->sub_membershipp->type}} membership @else <span style="color:red">Membership plan Deleted</span> @endif</td>
										<td>{{$cat->amount}}</td>
										<td>@if($cat->user != NULL){{$cat->user->name}}@else <span style="color:red">User Deleted </span>@endif</td>
										<td>{{date('d-M-Y', strtotime($cat->date_of_transaction))}}</td>
										<td>{{$cat->transaction_id}}</td>	
										<td>{{$cat->medium}}</td>	
										<td><span @if($cat->status=="success") style="color:green !important" @else style="color:green !important" @endif> {{$cat->status}}</span></td>	

											</td>
									</tr>
									<?php $i++; ?>
									 @endforeach
								</tbody>
								
							</table>
							<br>
							  <div class="d-flex w-100">
							  	<nav aria-label="Page navigation example" class="w-100" style="float:right !important">
				                  <ul class="pagination"  style="float:right !important">
				                {!! $user->links() !!}
				              </ul>
				            </nav>
				            </div>
						</div>
					</div>
				</div>


@endsection