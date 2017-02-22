@extends('layouts.app')
@section('content')
	<div class="section">
	<div class="row">
	<div class="col s8 offset-s3">
		

		<div class="card ">
			<div class="card-content">
				<span class = "card-title blue-text">Vehicle Requisition</span>
		 <div class="row">
    		<form class="col s12" method="POST" action="{{ route('transport.store') }}">
                        {{ csrf_field() }}
      			<div class="row">
      				<div class="input-field col s12 " >
      					<label for="purpose">*Purpose:</label>
      					<input type="text" name="purpose">
      					<span class = red-text> {{$errors->first('purpose' , ':message')}}</span>
      				</div>
      				<div class="input-field col s6">
      					<label for="destination">*Destination:</label>
      					<input type="text" name="destination">
      					<span class = "red-text">{{$errors->first('destination' , ':message')}}</span>
      				</div>
      				<div class="input-field col s6">
      					<label for="destination">*Number of Passengers:</label>
      					<input type="text" name="no_of_passengers">
      					<span class = "red-text">{{$errors->first('no_of_passengers' , ':message')}}</span>
      				</div>
      				
      				<div class="input-field col s12 m6">
      					<select class="browser-default" name="vehicle">
      						<option value="select vehicle " disabled selected>Select Vehicle </option>
      						<option value="a">Vehicle A</option>
      						<option value="b">Vehicle B</option>
      						<option value="c">Vehicle C</option>
      					</select>
      					<span class = "red-text">{{$errors->first('destination' , ':message')}}</span>
      				</div>
      				<div class="input-field col s12 m6">
      					<select class="browser-default" name="type_of_service">
      						<option value="" disabled selected>Select type of service</option>
      						<option value="Official">Official</option>
      						<option value="Private">Private</option>
      						<option value="Association">Association</option>
      					</select>
      					<span class = "red-text">{{$errors->first('destination' , ':message')}}</span>
      				</div>
      				<div class="input-field col s12 m6">
      					<label for="flight_no">Flight No (if applicable):</label>
      					<input type="text" name="flight_no">
      					<span class = "red-text">{{$errors->first('flight_no', ':message')}}</span>
      				</div>

      				<div class="input-field col s12 m6">
      					<label for="country">Country (if applicable):</label>
      					<input type="text" name="country">
      					<span class = "red-text">{{$errors->first('country', ':message')}}</span>
      				</div>

      				<div class=" col s12 m6">
      					<label for="departure_date">Depature Date:</label>
      					<input type="date" name="departure_date">
      					<span class = "red-text">{{$errors->first('departure_date', ':message')}}</span>
      				</div>
      				<div class=" col s12 m6">
      					<label for="return_date">Return Date:</label>
      					<input type="date" name="return_date">
      					<span class = "red-text">{{$errors->first('return_date', ':message')}}</span>
      				</div>
      				<div class="input-field col s12 m6">
      					<label for="departure_time">Departure Time:</label>
      					<input type="time" name="departure_time">
      					<span class = "red-text">{{$errors->first('departure_time', ':message')}}</span>
      				</div>
      				

      				<div class="input-field col s12 m6">
      					<label for="return_time">Return Time:</label>
      					<input type="time" name="return_time">
      					<span class = "red-text">{{$errors->first('return_time', ':message')}}</span>
      				</div>
      				
      				<div class="input-field col m6 offset-m5">
      					<button type="submit" class="btn btn-primary">Apply</button>
      				</div>
      			</div>	
      			
      		</form>		
      	</div>		
	</div>	
	</div>
			</div>
			</div>
		</div>
@endsection