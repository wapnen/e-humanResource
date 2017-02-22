@extends('layouts.app')
@section('content')
	<div class="section">
		<div class="row">
			<div class="col s8 offset-s3">
				<div class="card">
					<div class="card-content">
						<span class = "card-title blue-text">Request Details</span>
						<table class="bordered">
								<tr>
									<th>Current leave entitlement(days)</th><td>{{$leave->days_entitled}}</td>
								</tr>
								<tr>
									<th>Days taken</th><td>{{$leave->days_taken}}</td>
								</tr>
								<tr>
									<th>Leave due</th><td>{{$leave->leave_due}}</td>
								</tr>
								<tr>
									<th>Start date:</th><td>{{$leave->from}}</td>
								</tr>
								<tr>
									<th>End date:</th><td>{{$leave->to}}</td>
								</tr>
								<tr>
									<th>Authorization status</th><td>{{$leave->authorized}}</td>
								</tr>
								<tr>
									<th>Approval status</th><td>{{$leave->approved}}</td>
								</tr>
								@if($leave->money_entitled > 0)
								<tr>
									<th>Ammount entitled</th><td>{{$leave->money_entitled}}</td>
								</tr>
								@endif
								@if(Auth::user()->role == 'HOD')
									<tr>
									<th>Requesting officer</th><td>{{$user->name}}</td>
									</tr>						
								@endif
								@if(Auth::user()->role == 'deputy registrar')
									<tr>
									<th>Department</th><td>{{$department->name}}</td>
									</tr>
								@endif
						</table>
						<div class="col s4 offset-s4">
						@if(Auth::user()->role == "HOD")
						<div class="row">
							<div class="col s6">
								<a class = "btn btn-primary modal-trigger" href="#modal1">decline</a>
								
							</div>
							<div class="col s6">
								{!! Form::open(array('route'=>['leave.update',$leave->id],'method'=>'patch'))!!}
                                      {!! Form::hidden('authorized', 'authorized') !!}
                                      {!! Form::hidden('approved', 'Pending') !!}
                               <button class="btn waves-effect waves-light" type="submit" name="action">Authorize</button>
                           {!! Form::close() !!}
							</div>
							</div>
						@endif
						@if(Auth::user()->role == "deputy registrar")
						<div class="row">
							<div class="col s6">
								<a class = "btn btn-primary modal-trigger" href="#modal1">decline</a>
								
							</div>
							<div class="col s6">
								{!! Form::open(array('route'=>['leave.update',$leave->id],'method'=>'patch'))!!}
                                      {!! Form::hidden('authorized', 'authorized') !!}
                                      {!! Form::hidden('approved', 'approved') !!}
                               <button class="btn waves-effect waves-light" type="submit" name="action">Authorize</button>
                           {!! Form::close() !!}
							</div>
							</div>
						@endif	
						@if(Auth::user()->role == 'finance officer')
							<div class="row">
							<div class="col s6">
								<a class = "btn btn-primary modal-trigger" href="#modal2">Update</a>
								
							</div>
							
							</div>
						@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Reject request</h4>
          <div class="row">
                              {!! Form::open(array('route'=>['leave.update', $leave->id],'method'=>'patch'))!!}
                              {!! Form::label('comment' , 'Add remark') !!}
                              {!! Form::textarea('comment' ) !!}
                              {!! Form::hidden('authorized', 'declined') !!}
                              {!! Form::hidden('approved', 'declined') !!}

                               <button class="btn waves-effect waves-light" type="submit" name="action">Decline</button>
                           
                           {!! Form::close() !!}
          </div>
    </div>
   
               
  </div>
  <div id="modal2" class="modal">
    <div class="modal-content">
      <h4>Update entitlements</h4>
          <div class="row">
                              {!! Form::open(array('route'=>['leave.update', $leave->id],'method'=>'patch'))!!}
                              {!! Form::label('ammount' , 'Entitled Ammount') !!}
                              {!! Form::text('ammount' ) !!}
                             
                               <button class="btn waves-effect waves-light" type="submit" name="action">Update</button>
                           
                           {!! Form::close() !!}
          </div>
    </div>
   
               
  </div>

@endsection