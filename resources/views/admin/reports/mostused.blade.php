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
                                 <h6 class="mb-0 text-uppercase">Most Used Templates Report</h6>
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
										<th>Icon</th>
										<th>Use Count</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; ?>
									@foreach($populartools as $cat)
									<tr>
										<td>{{$i}}</td>
										<td>@if($cat->templates){{$cat->templates['name']}}@else @if($cat->tools==1000)AI Image @elseif($cat->tools==1001)Article Generator @else Template Deleted @endif @endif</td>
										<td>@if($cat->templates){{$cat->templates['slug']}}@else @if($cat->tools==1000)ai_image @elseif($cat->tools==1001)article_generator @else Template Deleted @endif @endif</td>
										<td>@if($cat->templates)<img src="{{$url_aws}}icon/{{$cat->templates->icon}}" style="width:50px;height:50px"> @else @if($cat->tools==1000)AI Image @elseif($cat->tools==1001)Article Generator @else Template Deleted @endif @endif</td>	
									    <td>{{$cat->total}}</td>
									</tr>
									<?php $i++; ?>
									 @endforeach
								</tbody>
								
							</table>
						</div>
					</div>
				</div>

@endsection