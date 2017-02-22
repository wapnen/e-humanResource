@extends('applications')
@section('appcontent')
	<div class="section">
		<div class="row">
			<div class="col s8 offset-s3">
				<div class="card">
					<div class="card-content">
						<table class="bordered">
							<thead>
								<th>Purpose</th>
								<th>Destination</th>
								
								<th>Service</th>
								<th>Authorization status</th>
								<th>Approval status</th>
								@if(Auth::user()->role == "director of transport" || Auth::user()->role == "HOD")
									<th>Requesting officer</th>
								@endif
								@if(Auth::user()->role == "director of transport" )
									<th>Department</th>
								@endif
								<th>Details</th>
							</thead>
							<tbody>
								@foreach($transport as $trans)
								<tr>
										<td>{{$trans->purpose}}</td>
										<td>{{$trans->destination}}</td>
										<td>{{$trans->type_of_service}}</td>
										<td>{{$trans->authorized}}</td>
										<td>{{$trans->approved}}</td>
										@if(Auth::user()->role == "director of transport" || Auth::user()->role == "HOD")
											@foreach($users as $user)
												@if($user->id == $trans->user_id)
													<td>{{$user->name}}</td>
													@foreach($departments as $department)
														@if($user->department_id == $department->id && Auth::user()->role == "director of transport")
															<td>{{$department->name}}</td>
														@endif
													@endforeach
												@endif
											@endforeach

										@endif
										<td><a class="btn" href="{{route('transport.show', $trans->id)}}"><i class="fa fa-eye center"></i></a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>	
		</div>
	</div>
@endsection