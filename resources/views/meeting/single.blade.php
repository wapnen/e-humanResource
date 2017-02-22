@extends('layouts.app')

@section('content')


  <div class="section">
         <div class="row">
           
               

           <div class="col s12 m9 offset-m3">

            <div class="card ">
              <div class="card-content">

  <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s3"><a class="active" href="#test1">Meeting Details</a></li>
        <li class="tab col s3"><a  href="#test2">Invited staff</a></li>
        
      </ul>
    </div>
    <div id="test1" class="col s12"><table class="bordered">
               
              		
                 		<tr><th>Title:</th><td>{{$meeting->title}}</td></tr>
                 		<tr><th>Organized by:</th>@foreach($users as $user) @if($user->id == $meeting->organizer)<td>{{$user->name}}</td>@endif @endforeach</tr>
                 		<tr><th>Meeting type:</th><td>{{$meeting->type}}</td></tr>
                 		<tr><th>Meeting venue:</th><td>{{$meeting->venue}}</td></tr>
                 		<tr><th>Meeting date:</th><td>{{$meeting->date}}</td></tr>
                 		<tr><th>Meeting time:</th><td>{{$meeting->time}}</td></tr>
             	  		<tr><th>Secretary:</th>

             	  		@if($meeting->secretary ==0 && Auth::user()->id ==$meeting->organizer)
             	  		<td> <form class="form-horizontal" role="form" method="POST" action="/secretary/{{$meeting->id}}">
                       			 {{ csrf_field() }} 
             	  				<div class="row">
             	  					<div class="input-field col s8">
             	  						<select name="secretary" class="browser-default">
             	  						<option value="" disabled selected>Select secretary</option>
             	  							@foreach($members as $member)
             	  								@foreach($users as $user)
             	  									@if($member->user_id == $user->id)
             	  										<option value="{{$user->id}}">{{$user->name}}</option>
             	  									@endif
             	  								@endforeach
             	  							@endforeach
             	  						</select>
             	  					</div>
             	  					<div class="input-field col s4">
             	  						<button class="btn btn-primary" type="submit" name="submit">Assign</button>
             	  					</div>
             	  				</div>		
             	  			</form>   
             	  		</td>
             	  		@else
             	  		@foreach($users as $user) @if($user->id == $meeting->secretary)<td>{{$user->name}}</td>@endif @endforeach
             	  		@endif
             	  		</tr>
             	  		<tr><th>Minutes:</th>
             	  		@if(count($minute) == 0)
             	  			<td>
							   {!! Form::open(array('route' => 'minute.store','method'=>'POST','files'=>true)) !!}
									 <div class="file-field input-field">
									 <div class="btn">
									<span>Browse</span>	
									{!! Form::file('minutes', array('class' => 'btn')) !!}
									
							      </div>
							        
							      <div class="file-path-wrapper">
							        <input class="file-path validate" type="text">
							      </div>
							    </div>
							    {!! Form::hidden('meeting_id' , $meeting->id) !!}
							    </td>
							    <td><button type="submit" name="submit" class="btn btn-primary">Submit</button></td>
							    {!! Form::close() !!}
					@else
					@foreach($minute as $min)
						<td><a target="_blank" class="btn" href='{{asset("minutes/$min->filename")}}'>View</a></td>
					@endforeach	
						@endif		        
							        
             	  		
             	  		</tr>
             	  		@if( Auth::user()->id == $meeting->organizer) <tr><td></td><td><a class="waves-effect waves-light btn modal-trigger" href="#modal3">Postpone</a></td></tr>	
            		@endif </table>
   			

   				</div>
    <div id="test2" class="col s12"><table class="bordered">
    		<thead>
    			<th>Name</th>
    			<th>Department</th>
    			<th>Attendance</th>
    		</thead>
    		<tbody>
    		<form method="post" action="{{route('attendance')}}">
             	  				{{ csrf_field() }}
             	  				<input type="hidden" name="meeting_id" value="{{$meeting->id}}" 
    		@foreach($members as $member)
             	 @foreach($users as $user)

             	 	@if($member->user_id == $user->id)
             	  				<tr><td>{{$user->name}}</td>	
             	  				@foreach($dept as $dep)@if($user->department_id == $dep->id)<td>{{$dep->name}}</td>@endif @endforeach		
             	  				@if($member->attendance == "Present" || $member->attendance == "Absent")
             	  				<td>{{$member->attendance}}</td>
             	  				@else 
             	  				<td>
                                          <input type="checkbox" id="user{{$user->id}}" name="{{$member->id}}" />
                                          <label for="user{{$user->id}}"></label>
                                 </td>
                                 @endif

             	  				</tr>
             	  		@endif
             	  @endforeach
            @endforeach
            <tr>
            	<td></td>
            	<td></td>
            	<td>
        				<button type="submit" name="submit" class="btn btn-primary">Submit attendance</button>
        				</form></td>
            </tr>
    		</tbody>
    	</table><div class="section col s6 offset-s5">

        			</div>

        			</div>
    	
  </div>
        			
                
                  	  
            		 <div class="card-action"><a href="route('meeting.index)">Back</a></div>
            		 </div>
   				</div>
   				
  			 </div>
  			 </div>
   		
  			 <!-- modal -->
				       <div id="modal3" class="modal">
				    <div class="modal-content">
				      <h4>Postpone to:</h4>
				          <div class="row">
				                            {!! Form::open(array('route'=>['meeting.update',$meeting->id],'method'=>'patch'))!!}
				                              
				                              {!! Form::date('date' , $meeting->date ) !!}
				                              {!! Form::time('time' , $meeting->time) !!}
				                               <button class="btn waves-effect waves-light" type="submit" name="action">Postpone</button>
				                           
				                           {!! Form::close() !!}
				          </div>
				    </div>
				   
				               
				  </div>
				          <!-- endmodal -->
   		</div>

   </div>               
@endsection