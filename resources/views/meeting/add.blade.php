@extends('layouts.app')
@section('content')
<div class="section">
	<div class="row">
	<div class="col s8 offset-s3">
		

		<div class="card ">
			<div class="card-content">
				<span class = "card-title blue-text">Call Meeting</span>
		 <div class="row">
    		<form class="col s12" method="POST" action="{{ route('meeting.store') }}">
                        {{ csrf_field() }}
      			<div class="row">
      				<div class=" input-field col s9">
      				<label for="title">Meeting Title:</label>
      					<input type="text" name="title">
      					<span class="red-text">{{$errors->first('title',':message')}}</span>
      				</div>
      			
      				<div class=" input-field col s3">
      					<select name="type" class="browser-default">
      						<option value="" disabled selected>Select meeting type</option>
      						<option value="committee">Committee meeting</option>
      						<option value="seminar">Seminar</option>
      						<option value="conference">Conference</option>
      						<option value="other">Other</option>
      					</select>
      					<span class="red-text">{{$errors->first('type',':message')}}</span>
      				</div>
      				<div class="input-field col s12">
      					<label for="venue">Meeting venue:</label>
      					<input type="text" name = "venue">
      					<span class="red-text">{{$errors->first('venue',':message')}}</span>
      				</div>
      				<div class="input-field col s6">
      					
      					<input type="date" name="date">
      					<span class = "red-text">{{$errors->first('date' , ':message')}}</span>
      				</div>
      				<div class="input-field col s6">
      					
      					<input type="time" name="time">
      					<span class = "red-text">{{$errors->first('time' , ':message')}}</span>
      				</div>
      					<div class="input-field col s6 offset-s5">
      						<button class ="btn btn primary" type= "submit" name="submit">Next</button>
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