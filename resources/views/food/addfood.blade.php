@extends('layouts.app')
@section('content')
	<div class="section">
	<div class="row">
	<div class="col s8 offset-s3">
		

		<div class="card ">
			<div class="card-content">
				<span class = "card-title blue-text">Food request</span>
		 <div class="row">
    		<form class="col s12" method="POST" action="{{ route('food.store') }}">
                        {{ csrf_field() }}
      			<div class="row">
      			<div class="input-field col s12">
      				<textarea id="purpose" name="purpose" class="materialize-textarea"></textarea>
          			<label for="purpose">Purpose for request:</label>
      			<span class="red-text">{{$errors->first('purpose',':message')}}</span>
                        </div>
      			<div class="input-field col s6">
      				<!-- <label for="delivery_date">
      					Delivery date:
      				</label> -->
      				<input type="date"  name="delivery_date" placeholder ="delivery_date">	
                              <span class="red-text">{{$errors->first('delivery_date',':message')}}</span>
      			</div>
      			<div class="input-field col s6">
      				<!-- <label >
      					Delivery time:
      				</label> -->
      				<input type="time"  name="time" placeholder = "time">	
                              <span class="red-text">{{$errors->first('time',':message')}}</span>
      			</div>
      			<div class="input-field col s6">
      				<label for="people">
      					Number of people:
      				</label>
      				<input type="number"  name="people">	
                              <span class="red-text">{{$errors->first('people',':message')}}</span>
      			</div>
      			<div class="input-field col s6">
      				<label for="phone">
      					Phone:
      				</label>
      				<input type="text"  name="phone">	
                              <span class="red-text">{{$errors->first('phone',':message')}}</span>
      			</div>
      			<div class="input-field col s4">
      				<input type="checkbox" id="test5" name="breakfast" />
      				<label for="test5">Breakfast</label>	
      			</div>
      			<div class="input-field col s4">
      				<input type="checkbox" id="test6" name="lunch" />
      				<label for="test6">Lunch</label>	
      			</div>
      			<div class="input-field col s4">
      				<input type="checkbox" id="test7" name="supper" />
      				<label for="test7">Supper</label>	
      			</div>
      			<div class="input-field col s4">
      				<input type="checkbox" id="test8" name="pastries" />
      				<label for="test8">Pastries</label>	
      			</div>
      			<div class="input-field col s4">
      				<input type="checkbox" id="test9" name="drink" />
      				<label for="test9">Drink</label>	
      			</div>
      			<div class="input-field col s4">
      				<input type="checkbox" id="test1" name="voltic" />
      				<label for="test1">Voltic</label>	
      			</div>
                        <span class="red-text">{{$errors->first('type',':message')}}</span>
      			<div class="card-action col s12 offset-s5">
      				<button class="btn waves-effect waves-light" type="submit" name="action">Submit </button>
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