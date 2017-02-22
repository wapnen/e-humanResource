@extends('layouts.app')
@section('content')
	<div class="section">
		<div class="row">
			<div class="col m8 offset-m3">
				<div class="card">
					<div class="card-content">
					<span class = "card-title blue-text">Leave Application</span>
						<form method="post" action="{{route('leave.store')}}">
						{{csrf_field()}}
							<div class="row">
								<div class="input-field col m6">
									<label for="days_entitled">Current Entitlement:</label>
									<input type="text" name="days_entitled">
									<span class = "red-text">{{$errors->first('days_entitled',':message')}}</span>
								</div>
								
								<div class="input-field col m6">
									<label for="days_taken">Days already Taken:</label>
									<input type="text" name="days_taken">
									<span class = "red-text">{{$errors->first('days_taken',':message')}}</span>
								</div>
								<div class="input-field col m6">
									<label for="leave_due">Leave due:</label>
									<input type="text" name="leave_due">
									<span class = "red-text">{{$errors->first('leave_due',':message')}}</span>
								</div>
								<div class="input-field col m6">
									<label for="days_approved">Approved days to be taken:</label>
									<input type="text" name="days_approved">
									<span class = "red-text">{{$errors->first('days_approved',':message')}}</span>
								</div>

								<div class="input-field col m6">
									<label for="from">From:</label>
									<input type="date" name="from">
									<span class = "red-text">{{$errors->first('from',':message')}}</span>
								</div>
								<div class="input-field col m6">
									<label for="to">To:</label>
									<input type="date" name="to">
									<span class = "red-text">{{$errors->first('to',':message')}}</span>
								</div>

								<div class="input-field col m6">
									<label for="resumption_date">Resumption date:</label>
									<input type="date" name="resumption_date">
									<span class = "red-text">{{$errors->first('resumption_date',':message')}}</span>
								</div>
								<div class="input-field col m6">
									<label for="phone">Phone:</label>
									<input type="text" name="phone">
									<span class = "red-text">{{$errors->first('phone',':message')}}</span>
								</div>
								<div class="input-field col m12">
									<label for="address">Leave Address:</label>
									<input type="text" name="address">
									<span class = "red-text">{{$errors->first('address',':message')}}</span>
								</div>
								<div class=" input-field col s5 offset-s5">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection