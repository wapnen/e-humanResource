@extends('applications')
@section('appcontent')
	<div class="section">
		<div class="row">
			<div class="col m8 offset-m3">
				<div class="card">
					<div class="card-content">
						<table>
							<thead>
								<tr>
								<th>Days entitled</th>
								<th>Outstanding days</th>
								<th>Days taken</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Money Entitled</th>
								@if(Auth::user()->role == 'HOD' || Auth::user()->role == 'deputy registrar' || Auth::user()->role == 'finance officer')
								<th>Requesting Officer</th>
								@endif
								@if( Auth::user()->role == 'deputy registrar' ||  Auth::user()->role == 'finance officer')
								<th>Department</th>
								@endif
								
								<th>Details</th>
								</tr>
							</thead>
							<tbody>
								@foreach($leave as $leave)
									<tr>
										<td>{{$leave->days_entitled}}</td>
										
										<td>{{$leave->outstanding_leave}}</td>
										<td>{{$leave->days_taken}}</td>
										<td>{{$leave->from}}</td>
										<td>{{$leave->to}}</td>
										<td>{{$leave->money_entitled}}</td>
										@if(Auth::user()->role == 'HOD' || Auth::user()->role == 'finance officer' || Auth::user()->role == 'deputy registrar')
												@foreach($users as $user)
												@if($user->id == $leave->user_id)
												<td>{{$user->name}}</td>
												@if(Auth::user()->role == 'finance officer' || Auth::user()->role == 'deputy registrar')
												
												@foreach($departments as $department)
													@if($department->id == $leave->department_id)
													<td>{{$department->name}}</td>
													@endif
												@endforeach


												@endif
												@endif
												
												@endforeach
										@endif

										<td><a class="btn btn-primary" href="{{route('leave.show' , $leave->id)}}"><i class="fa fa-eye center"></a></td>
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