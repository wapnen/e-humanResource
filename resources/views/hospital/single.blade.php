@extends('layouts.app')

@section('content')
	<div class="section">
		<div class="row">
			<div class="col s8 offset-s3">
				<div class="card">
					<div class="card-content">
						<span class = "card-title blue-text">Hospital Charge</span>
						<table class="bordered">
							<tr>
								<th>Patient Name</th>
								<td>{{$healthcharge->patient_name}}</td>
							</tr>
							<tr>
								<th>Folder Number</th>
								<td>{{$healthcharge->folder_no}}</td>
							</tr>
							<tr>
								<th>Account Code</th>
								<td>{{$healthcharge->account_code}} ({{$healthcharge->account_type}})</td>
							</tr>
							<tr>
								<th>Total(GHc)</th>
								<td>{{$healthcharge->total}}</td>
							</tr>
							@if(Auth::user()->role == "Cashier" && Auth::user()->department_id == 8 )
							<tr>
								<th>Cheque status</th>
								<td>{{$healthcharge->recieved}}</td>
							
							</tr>
							@elseif(Auth::user()->role == "finance officer" && Auth::user()->department_id == 5)
							<tr>
								<th>Status</th>
								<td>{{$healthcharge->deducted}}</td>
							</tr>
							@endif

						</table>

						<div class="section">
							<span>Breakdown</span>
							<table>
									<thead>
										<th>Service(s)</th>
										<th>Cost(GHc)</th>
									</thead>
								@foreach($healthservices as $healthservice)
									<tr>
										<td>{{$healthservice->type}}</td>
										<td>{{$healthservice->ammount}}</td>
									</tr>
								@endforeach
							</table>
						</div>
						<div class="card-action">
							<a href="{{route('healthcharge.index')}}">Back</a>
							<a href="{{route('hospitalinvoice' , $healthcharge->id)}}">Print invoice</a>
						</div>
					</div>
				</div>
				@if(Auth::user()->role == "Cashier" && Auth::user()->department_id == 8 )
								@if($healthcharge->recieved == "Not recieved")
								
									
										<div class="row">
										{!! Form::open(array('route'=>['healthcharge.update',$healthcharge->id],'method'=>'patch'))!!}
                                      {!! Form::hidden('recieved', 'Recieved') !!}
                              
											<div class="input-field col s6 offset-s5">
												<button class="btn btn-primary">Cheque recieved</button>
											</div>
										</div>
									 {!! Form::close() !!}
								@endif
				@elseif(Auth::user()->role == "finance officer" && Auth::user()->department_id == 5 )
								@if($healthcharge->deducted == "Not deducted")
								
									
										<div class="row">
										{!! Form::open(array('route'=>['healthcharge.update',$healthcharge->id],'method'=>'patch'))!!}
                                      {!! Form::hidden('recieved', 'Deducted') !!}
                              
											<div class="input-field col s6 offset-s5">
												<button class="btn btn-primary">Confirm Deduction</button>
											</div>
										</div>
									 {!! Form::close() !!}
								@endif
				@endif				
			</div>
		</div>
	</div>

@endsection