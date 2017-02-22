@extends('layouts.app')
@section('content')
<div class="section">
	<div class="row">
	<div class="col s8 offset-s3">
	<div class="card ">
			<div class="card-content">
				<span class = "card-title blue-text">Maintenance request</span>
		 <div class="row">
    		<form class="col s12" method="POST" action="{{ route('maintenance.store') }}">
                        {{ csrf_field() }}
      			<div class="row">
      			<div class="input-field col s6" >
      				<label for="facility_name">
      					Name of facility:
      				</label>
      				<input type="text" name="facility_name">
      				<span class="red-text">{{$errors->first('facility_name',':message')}}</span>
      			</div>
      			<div class="input-field col s6" >
      				<label for="location">
      					Specific location:
      				</label>
      				<input type="text" name="location">
      				<span class="red-text">{{$errors->first('location',':message')}}</span>
      			</div>
      			<div class="input-field col s6" >
      				<select class="browser-default" name="type" id="maintenancetype">
      					<option value ="" disabled selected>Select type of work</option>
      					<option value="masonry">Masonry</option>
      					<option value="electric">Electrical work</option>
      					<option value="plumbing">Plumbing</option>
      					<option value="carpentry">Carpentry</option>
      					<option value="other">Other request</option>

      				</select>
      				<span class="red-text">{{$errors->first('purpose',':type')}}</span>
      			</div>
      			<div class="input-field col s6" >
      				<select class="browser-default" name="subtype" id="subtypes">
      					<option value ="" disabled selected>Select specific area</option>
  						
      				</select>
      			</div>
      			<div class="input-field col s12">
      				<label for="description">Description of work or problem:</label>
      				<textarea class="materialize-textarea" name="description"></textarea>
      				<span class="red-text">{{$errors->first('description',':message')}}</span>
      			</div>
      			<div class="input-fiel col s6 offset-s5">
      				<button class="btn btn-primary" type="submit" name="submit">Submit</button>
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