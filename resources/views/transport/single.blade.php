@extends('layouts.app')

@section('content')


  <div class="section">
         <div class="row">
           
               

           <div class="col s12 m9 offset-m3">

            <div class="card ">
              <div class="card-content">
                  <span class = "card-title teal-text">Request Details </span>
              
             <table class="bordered">
               <tr><th>Purpose:</th><td>{{$transport->purpose}}</td></tr>
               <tr><th>Destination:</th><td>{{$transport->destination}}</td></tr>
               @if($transport->flight_no != "")
               	<tr><th>Flight number:</th><td>{{$transport->flight_no}}</td></tr>
               @endif
               <tr><th>Country:</th><td>{{$transport->country}}</td></tr>
               <tr><th>Passengers:</th><td>{{$transport->no_of_passengers}}</td></tr>
               <tr><th>Departure:</th><td>{{$transport->departure_date}} , {{$transport->departure_time}}</td></tr>
               <tr><th>Return:</th><td>{{$transport->return_date}}, {{$transport->return_time}}</td></tr>
               <tr><th>Type of Service:</th><td>{{$transport->type_of_service}}</td></tr>
               @if(Auth::user()->id != $transport->user_id)
               	<tr><th>Requesting officer:</th><td>{{$user->name}}</td></tr>
               	@endif
               	@if($transport->authorized != "")
               		<tr><th>Authorization status (Department):</th><td>{{$transport->authorized}}</td></tr>
               		<tr><th>Approval status (Transport):</th><td>{{$transport->approved}}</td></tr>
               	@endif
             </table>
             
    		</div>
   
               <div class="card-action">
             
               	<a  href="{{route('transport.index')}}">Back</a>
             	@if($transport->cost > 0)
              		<a href="{{route('transportinvoice' , $transport->id )}}">Invoice</a>
              	@endif
               </div>
  			</div>
  				<div class="row">
  					<div class="col s6 offset-s4">
  						<div class="row">
  						<div class="col s6">
  							  @if($transport->authorized == "" && Auth::user()->role == "HOD")
				               	<a class="waves-effect waves-light btn modal-trigger" href="#modal1">Decline</a>
				               
						      	
				                
  						</div>
  						<div class="col s6">
  								{!! Form::open(array('route'=>['transport.update',$transport->id],'method'=>'patch'))!!}
  							{!! Form::hidden('authorized', 'Authorized ') !!}
				                {!! Form::hidden('approved', 'Pending') !!}
				                <button class="btn waves-effect waves-light" type="submit" name="action">Authorize</button>
				               {!! Form::close() !!}
				               	
				               	@endif
  						</div>
  							<div class="col s6">
  									@if($transport->approved == "Pending" && Auth::user()->role == "director of transport")
				               	<a class="waves-effect waves-light btn modal-trigger" href="#modal1">Decline</a>
				               	</div>
				               	{!! Form::open(array('route'=>['transport.update',$transport->id],'method'=>'patch'))!!}
						      	{!! Form::hidden('authorized', 'Authorized ') !!}
				                {!! Form::hidden('approved', 'Approved') !!}
				                <div class="col s6">
				                <button class="btn waves-effect waves-light" type="submit" name="action">Approve</button>
				               	</div>
				               {!! Form::close() !!}
				               	@elseif($transport->approved == "Approved" && Auth::user()->role == "director of transport")
				               	<div class="col s6"><a class="btn modal-trigger" href="#modal2">Update</a></div>
				               	@endif
  							
  						</div>
  					</div>
  				</div>
         </div>
        </div>


       <!-- Modal to decline request from HOD -->
       	<div id="modal1" class="modal">
		    <div class="modal-content">
		      <h4>Decline Request</h4>
		      {!! Form::open(array('route'=>['transport.update',$transport->id],'method'=>'patch'))!!}
		      	{!! Form::textarea('remark')!!}
                {!! Form::hidden('authorized', 'Declined ') !!}
                {!! Form::hidden('approved', 'Declined') !!}
                <button class="btn waves-effect waves-light" type="submit" name="action">Decline</button>
               {!! Form::close() !!}
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
		    </div>
		  </div>
          
       <!-- endmodal -->

       <!-- Modal to update details by dot -->
       	<div id="modal2" class="modal">
		    <div class="modal-content">
		      <h4>Update details</h4>
		      <form method="post" action="{{route('officialtransport', $transport->id)}}">
		      	{{csrf_field()}}
		      	<div class="row">
		      		<div class="input-field col m6">
		      			<label for="driver">Driver:</label>
		      			<input type="text" name="driver">
		      			<span class = "red-text">{{$errors->first('driver', ':message')}}</span>
		      		</div>
		      		<div class="input-field col m6">
		      			<label for="perdiem">Perdiem(GHc):</label>
		      			<input type="text" name="perdiem">
		      			<span class = "red-text">{{$errors->first('perdiem', ':message')}}</span>
		      		</div>
		      		<div class="input-field col m6">
		      			<label for="vehicle_charge">Vehicle Charge(GHc):</label>
		      			<input type="text" name="vehicle_charge">
		      			<span class = "red-text">{{$errors->first('vehicle_charge', ':message')}}</span>
		      		</div>
		      		<div class="input-field col m6">
		      			<label for="km_covered">Kilometers covered:</label>
		      			<input type="text" name="km_covered">
		      			<span class = "red-text">{{$errors->first('km_covered)', ':message')}}</span>
		      		</div>
		      		<div class="input-field col m6">
		      			<label for="qty_fuel">Fuel Quantity:</label>
		      			<input type="text" name="qty_fuel">
		      			<span class = "red-text">{{$errors->first('qty_fuel', ':message')}}</span>
		      		</div>
		      		<div class="input-field col m6">
		      			<label for="cost">Cost:</label>
		      			<input type="text" name="cost">
		      			<span class = "red-text">{{$errors->first('cost', ':message')}}</span>
		      		</div>
		      		<div class="input-field col s6 offset-s5">
		      			<button class="btn" name="submit" type="submit">Update</button>
		      		</div>
		      	</div>
		      </form>
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
		    </div>
		  </div>
          
       <!-- endmodal -->

   </div>     

@endsection

