
@extends('userweb.layout.app')

@section('content')

<style>
	#example2_filter {
  float: right;
  margin-bottom: 10px;
}
</style>
				<div class="card">
                      <div class="card-header">
                                 <h6 class="mb-0 text-uppercase">Generated History </h6>
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
										<th>prompt</th>
										<th>Generated Text</th>
										<th>Tokens Used</th>
										<th>Generated On</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; ?>
									@foreach($user as $cat)
									<tr>
										<td>{{$i}}</td>
										<td>{{Str::limit($cat->prompt,40)}}</td>
										<td>{!! Str::limit($cat->results,20) !!}</td>
										<td>{{$cat->token_used}}</td>	
										<td>{{date('d-M-Y', strtotime($cat->created_at))}}</td>
										<td><a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewproject{{$cat->id}}">View Full Text</a>

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
	@foreach($user as $cat)
				 <!-- Modal -->
            <div class="modal fade" id="viewproject{{$cat->id}}" tabindex="-1" aria-labelledby="viewprojectLabel{{$cat->id}}" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="viewprojectLabel{{$cat->id}}">Generated Text</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                  </div>
              
                  <div class="modal-body">
                        <div class="form-group">
                         <label id="folderLabel">Prompt Text</label>
                         
                          <textarea class="form-control" disabled readonly>{!! $cat->prompt !!}</textarea>
                        
                       </div>
                        <br> 
                       <div class="form-group">
                         <label id="folderLabel">Generated Text</label>
                         
                          <textarea class="form-control" rows="15" disabled readonly>{!! $cat->results !!}</textarea>
                        
                       </div>
                        <br>

                    
                      
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                
                
                </div>
              </div>
            </div>
            @endforeach

@endsection