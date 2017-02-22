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
								<th>Delivery site</th>
								<th>Approval status (HOD)</th>
								<th>Approval status (Procurement)</th>
								@if(Auth::user()->role == 'HOD' || Auth::user()->role == 'finance officer')
								<th>Requesting Officer</th>
								@endif
								
								<th>Total</th>
								<th>Date requested</th>
								<th>Details</th>
								</tr>
							</thead>
							<tbody>
								@foreach($purchase as $purchase)
									<tr>
										<td>{{$purchase->delivery_site}}</td>
										
										<td>{{$purchase->authorized}}</td>
										<td>{{$purchase->approved}}</td>
										@if(Auth::user()->role == 'HOD' || Auth::user()->role == 'finance officer')
												@foreach($users as $user)
												@if($user->id == $purchase->user_id)
												<td>{{$user->name}}</td>
												@if(Auth::user()->role == 'finance officer')
												
												@endif
												@endif
												
												@endforeach
										@endif
										<td>{{$purchase->total}}</td>
										<td>{{$purchase->created_at}}</td>
										<td><a class="btn btn-primary" href="{{route('purchase.show' , $purchase->id)}}"><i class="fa fa-eye center"></a></td>
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