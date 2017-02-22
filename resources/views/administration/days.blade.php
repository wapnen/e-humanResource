@extends('layouts.app')

@section('content')
				<div class="section">
					
				
  
						<div class="row">

										<?php $duration = session('duration');   ?>
								{!! Form::open(array('route'=>'facilityDays.store','files'=>'true')) !!}
									
								
								<div class="col m8 offset-m4 ">
								<div class="card">
									<div class="card-content">
										<span class="card-title blue-text center"> Enter meeting date(s) and Time(s)</span>
									<div class="row">
										
										@for($i = 0; $i < $duration; $i++)
							 <div class="input-field col m6 {!! $errors->has('name')? "has-error":"" !!}">
							 {!! Form::label('date','Enter date:') !!}
							 {!! Form::date('date'.$i,null) !!}
							  {!! $errors->first('date','<span class="help-block">:message</span>') !!}
							     </div>
							     <div class="input-field col m6 {!! $errors->has('name')? "has-error":"" !!}">
							 {!! Form::label('time','Enter time:') !!}
							 {!! Form::time('time'.$i,null) !!}
							  {!! $errors->first('time','<span class="help-block">:message</span>') !!}
							     </div>
							 @endfor
							         <div class="input-field ">
							    <div class="col m4 offset-m5">
							 {!! Form::submit('Continue',['class'=>' col moffset-12 btn btn-primary btn-block']) !!}
					    </div>
					        {!! Form::close() !!}
									</div>	


					</div>
				</div>
									</div>
								</div>
									
									
			</div>
			</div>
@endsection