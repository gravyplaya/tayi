@extends('admin.layout.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
	#example2_filter {
  float: right;
  margin-bottom: 10px;
}
</style>

				<div class="card">
                      <div class="card-header">
                                 <h6 class="mb-0 text-uppercase">Liked/Disliked Report</h6>
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
										<th>Template Name</th>
										<th>Prompt</th>
										<th>Response</th>
										<th>User</th>
										<th>Liked/Disliked</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; ?>
									@foreach($history as $cat)
									<tr>
										<td>{{$i}}</td>
										<td>@if($cat->templates){{$cat->templates['name']}}@else @if($cat->tools==1000)AI Image @elseif($cat->tools==1001)Article Generator @else Template Deleted @endif @endif</td>
										<td>{{$cat->prompt}}</td>
										<td>{!! \Str::limit($cat->results,30) !!}</td>	
										<td>{{$cat->user->name}}<br>{{$cat->user->email}}</td>	
									    <td class="text-center">@if($cat->like_dislike != 0) @if($cat->like_dislike==1)<button class="copy-text btn btn-inverse-secondary" ><i class="fa fa-thumbs-up" aria-hidden="true"></i> </button> @else <button class="copy-text btn btn-inverse-secondary"><i class="fa fa-thumbs-down" aria-hidden="true"></i> </button>@endif @else No Response yet @endif</td>
										<td><a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewproject{{$cat->id}}">View Full Text</a>

											</td>
									</tr>
									<?php $i++; ?>
									 @endforeach
								</tbody>
								
							</table>
							  <div class="d-flex w-100">
							  	<nav aria-label="Page navigation example" class="w-100" style="float:right !important">
                  <ul class="pagination"  style="float:right !important">
                {!! $history->links() !!}
              </ul>
            </nav>
            </div>
						</div>
					</div>
				</div>
	@foreach($history as $cat)
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
                       
                        @if($cat->image != NULL)
                       	<label> Generated image </label>

                       	 <div class="article-thumb"> <img src="{{$url_aws}}images/{{$cat->image}}" style="width: 100%;"></div>
                         @else
                         <div class="form-group">
                         <label id="folderLabel">Generated Text</label>
                         
                          <textarea class="form-control" rows="15" disabled readonly>{!! $cat->results !!}</textarea>
                        
                       </div>
                         <br>

                        @endif
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