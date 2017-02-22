@extends('layouts.app')
@section('content')
	<div class="section">
		<div class="row">
			<div class="col m8 offset-m3">
				<div class="card">
					<div class="card-content">
					<span class = "card-title teal-text">Details</span>
						<table class="bordered">
							<tr><th>Delivery Site</th><td>{{$purchase->delivery_site}}</td></tr>
							<tr><th>Total</th><td>GHc {{$purchase->total}}</td></tr>
							<tr><th>Approval status(HOD)</th><td>{{$purchase->authorized}}</td></tr>
							<tr><th>Approval status(Procurement)</th><td>{{$purchase->approved}}</td></tr>
							@if(Auth::user()->role == 'HOD' || Auth::user()->role == 'finance officer')
							<tr><th>Requesting Officer</th>					
												<td>{{$user->name}}</td></tr></tr>
												@if(Auth::user()->role == 'finance officer')
													<tr><th>Department</th><td>{{$department->name}}</td></tr>
													@endif
												
											
										@endif
							@if($purchase->vetted == "Vetted")<tr><th>Vetting status</th><td>{{$purchase->vetted}}</td></tr>@endif			
							<tr><th>Date</th><td>{{$purchase->created_at}}</td></tr>			
						</table>
						<table>
							<thead>
								<tr>
									<th>Unit</th>
									<th>Quantity</th>
									<th>Unit Price</th>
									<th>Description</th>
								</tr>

							</thead>
							<tbody>
								@if(Auth::user()->role != 'procurement officer')
								@foreach($items as $item)
									<tr>
										<td>{{$item->unit}}</td>
										<td>{{$item->quantity}}</td>
										<td>GHC {{$item->unit_price}}</td>
										<td>{{$item->description}}</td>
									</tr>
								@endforeach
								@elseif(Auth::user()->role == 'procurement officer' && $purchase->vetted == 'pending')
								{!! Form::open(array('route'=> 'vet','method'=>'post'))!!}
                                    {!! Form::hidden('purchaseid', $purchase->id) !!}  
								@foreach($items as $item)
									<tr>
									{!! Form::hidden('itemid[]', $item->id) !!}
									<td>{!! Form::text('unit[]', $item->unit) !!}</td>
									<td>{!! Form::text('quantity[]', $item->quantity) !!}</td>
									<td>{!! Form::text('unit_price[]', $item->unit_price) !!}</td>
                                      
									 <td>{{$item->description}}</td>
									
										</tr>
								@endforeach
								<div class="col s6 offset-s5">
									  <button class="btn waves-effect waves-light" type="submit" name="action">UPDATE</button>
                        </div>
							{!! Form::close() !!}
								@elseif(Auth::user()->role == 'procurement officer' && $purchase->vetted == 'Vetted')
								@foreach($items as $item)
									<tr>
										<td>{{$item->unit}}</td>
										<td>{{$item->quantity}}</td>
										<td>GHC {{$item->unit_price}}</td>
										<td>{{$item->description}}</td>
									</tr>

								@endforeach
								@endif

								
							</tbody>
						</table>
						@if(Auth::user()->role == 'procurement officer' && $purchase->vetted == 'Vetted')
														@endif				

					</div>
					<div class="card-action">
						<a href="{{route('purchase.index')}}">Back</a>
												@if($ravail == 0)
						@if(Auth::user()->role == 'procurement officer' && $ravail == 0)
						<a class="waves-effect waves-light  modal-trigger" href="#modal3">Add Reciept</a>
						
						@endif
						@endif
						@if($ravail == 1)
						<a class="waves-effect waves-light  " target="_blank" href='{{asset("reciepts/$reciept")}}'>View Reciept</a>
						
						@endif
						</div>
				</div>
				@if(Auth::user()->role == 'HOD')
					<div class="row">
						<div class="col s6 offset-s3">
							<div class="row">
									<div class="col s6"><a class="waves-effect waves-light btn modal-trigger" href="#modal1">Decline</a> </div>  
                  <div class="col s6">{!! Form::open(array('route'=>['purchase.update',$purchase->id],'method'=>'patch'))!!}
                                      {!! Form::hidden('authorized', 'authorized by the department and pending confirmation from Finance office ') !!}
                                      {!! Form::hidden('approved', 'pending') !!}
                               <button class="btn waves-effect waves-light" type="submit" name="action">Authorize</button>
                           {!! Form::close() !!}
								</div>
							</div>
						</div>
					</div>

				@endif
				@if(Auth::user()->role == 'finance officer')
					<div class="row">
						<div class="col s6 offset-s3">
							<div class="row">
							@if($purchase->approved != "Approved")
									<div class="col s6"><a class="waves-effect waves-light btn modal-trigger" href="#modal1">Decline</a> </div>  
                  <div class="col s6">{!! Form::open(array('route'=>['purchase.update',$purchase->id],'method'=>'patch'))!!}
                                      {!! Form::hidden('authorized', 'Approved') !!}
									  {!! Form::hidden('approved', 'Approved') !!}
                               <button class="btn waves-effect waves-light" type="submit" name="action">Authorize</button>
                           {!! Form::close() !!}
								</div>
							@endif
							@if($purchase->vetted == "Vetted")
							<div class="col s6 offset-s3"><a class="waves-effect waves-light btn modal-trigger" href="#modal2">Cheque</a> </div>  

							@endif
							</div>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
	<div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Reject request</h4>
          <div class="row">
                            {!! Form::open(array('route'=>['purchase.update', $purchase->id],'method'=>'patch'))!!}
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
      <h4>Cheque details</h4>
     
      @if($ravail == 1)
      @foreach($cheque as $cheque)
          <div class="row">
          <table >
          			<tr>
          				<th>Name of officer</th><td>{{$cheque->name}}</td>

          			</tr>
          			<tr>
          				<th>Ammount Given</th><td>GHC {{$cheque->ammount}}</td>
          			</tr>
          		</table>
                
          </div>
       
        @endforeach
           @else	 
                            {!! Form::open(array('route'=>['purchasecheque', $purchase->id],'method'=>'post'))!!}
                              {!! Form::label('name' , 'Name of officer') !!}
                              {!! Form::text('name' ) !!}
                              {!! Form::label('ammount' , 'Ammount') !!}
                              
                              {!! Form::text('ammount') !!}
                              <div class="col s12 offset-s5">
                               <button class="btn waves-effect waves-light" type="submit" name="action">save</button>
                           </div>
                           {!! Form::close() !!}
                    @endif         
       
    </div>
   
               
  </div>
   <div id="modal3" class="modal">
    <div class="modal-content">
      <h4>Upload reciept</h4>
          <div class="row">
                            {!! Form::open(array('route' => 'purchasereciept','method'=>'POST','files'=>true)) !!}
									 <div class="file-field input-field">
									 <div class="btn">
									<span>Browse</span>	
									{!! Form::file('reciept', array('class' => 'btn')) !!}
									
							      </div>
							        
							      <div class="file-path-wrapper">
							        <input class="file-path validate" type="text">
							      </div>
							    </div>
							    {!! Form::hidden('purchase_id' , $purchase->id) !!}
							  
							  <div class="col s5 offset-s5"> <button type="submit" name="submit" class="btn btn-primary">Submit</button>
							  </div>
							   {!! Form::close() !!}
          </div>
    </div>
   
               
  </div>

@endsection

	