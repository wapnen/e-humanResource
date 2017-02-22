@extends('layouts.app')

@section('content')


  <div class="section">
         <div class="row">
           
               

           <div class="col s12 m9 offset-m3">

            <div class="card ">
              <div class="card-content">
                  <span class = "card-title teal-text">Request Details </span>
              
             <table class="bordered">
               <thead>
                 <tr>
                   <th>Purpose</th>
                  
                   <th>Participants</th>
                   
                   <th>Type(s)</th>
                   <th>To be delivered</th>
                   <th>Approval status</th>
                   <th>Authorization status</th>
                   <th>Requested on</th>
                   <th>Requested by</th>
                   <th>Department</th>
                   
                 </tr>
               </thead>
               <tbody>
               
                   <tr>
                     <td>{{$fid->purpose}}</td>
                     <td>{{$fid->people}}</td>
                     <td><ul class="collection">@foreach($type as $typ)
                        @if($typ->food_id == $fid->id)

                          <li class="collection-item">{{$typ->type}}</li>
                        @endif
                     @endforeach</ul></td>
                     <td>{{$fid->delivery_date}}</td>
                     <td>{{$fid->submit_status}}</td>
                     <td>{{$fid->approval_status}}</td>
                     <td>{{$fid->created_at}}</td>
                      @foreach($user as $use)
                      <td>{{$use->name}}</td>
                      @endforeach
                    
                      <td>{{$dept->name}}</td>
                    
                   </tr>
               
               </tbody>
              
                 
               </div>
             </table>

             @if($fid->ammount_charged == 0.00)
             @if(Auth::user()->department_id == 6)
              <div class="row">
             
                <div class="input-field col s8">
                    <label for="ammount">Ammount charged</label>
              
                    {!! Form::open(array('route'=>['ammount',$fid->id],'method'=>'post'))!!}
                    {!! Form::text('ammount' ) !!}
                    {!! Form::hidden('id', $fid->id)!!}                 
                  </div>
                  <div class="input-field col s4">
                   <button class="btn waves-effect waves-light" type="submit" name="action">Send</button>
                    {!! Form::close() !!}
                  </div>
             </div>
             @endif
              @else
              <div class="row">
                <div class="col s6 offset-s5">
                  Ammount charged: GHc{{$fid->ammount_charged}}
                </div>
              </div>
              @endif

              </div>
              <div class="card-action"><a  href="{{route('food.index')}}" class=" modal-action modal-close waves-effect waves-green btn-flat">Back</a>
              </div>
            </div>
            <div class="col m6 offset-m4">
            <div  class="row">
                <div class="col s4">
                
                </div>
            
            
            </div>
              </div>
            
           </div>
            @if(Auth::user()->role == "HOD")
              @if($fid->submit_status != "submitted")
             
         <div class="col s4 offset-s5">
                <div class="row">
                  <div class="col s6"><a class="waves-effect waves-light btn modal-trigger" href="#modal1">Decline</a> </div>  
                  <div class="col s6">{!! Form::open(array('route'=>['food.update',$fid->id],'method'=>'patch'))!!}
                                      {!! Form::hidden('status', 'authorized by the department and pending approval from Administration ') !!}
                                      {!! Form::hidden('approval_status', 'Pending approval') !!}
                               <button class="btn waves-effect waves-light" type="submit" name="action">Authorize</button>
                           {!! Form::close() !!}</div>
                </div> 
                </div>
                 
          @elseif($fid->submit_status == "submitted" && Auth::user()->department_id == 5)
          @if($fid->approval_status == "Pending approval") 
                     <div class="col s4 offset-s5">
                <div class="row">
                  <div class="col s6"><a class="waves-effect waves-light btn modal-trigger" href="#modal2">Decline</a> </div>  
                  <div class="col s6">{!! Form::open(array('route'=>['food.update',$fid->id],'method'=>'patch'))!!}
                                      
                                      {!! Form::hidden('status', 'Approved!') !!}
                                      {!! Form::hidden('approval_status', 'Approved!') !!}
                               <button class="btn waves-effect waves-light" type="submit" name="action">Authorize</button>
                           {!! Form::close() !!}</div>
                </div> 
                </div>
                @endif
                @endif 
                @endif
         </div>
       </div>

       <!-- modal -->
       <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Reject request</h4>
          <div class="row">
                            {!! Form::open(array('route'=>['food.update',$fid->id],'method'=>'patch'))!!}
                              {!! Form::label('comment' , 'Add remark') !!}
                              {!! Form::textarea('comment' ) !!}
                              {!! Form::hidden('status', 'declined') !!}
                              {!! Form::hidden('approval_status', 'declined') !!}

                               <button class="btn waves-effect waves-light" type="submit" name="action">Decline</button>
                           
                           {!! Form::close() !!}
          </div>
    </div>
   
               
  </div>
          <!-- endmodal -->
 <!-- modal -->
       <div id="modal2" class="modal">
    <div class="modal-content">
      <h4>Reject request</h4>
          <div class="row">
                            {!! Form::open(array('route'=>['food.update',$fid->id],'method'=>'patch'))!!}
                              
                              {!! Form::textarea('comment' ) !!}
                              {!! Form::hidden('status', 'declined') !!}}
                              {!! Form::hidden('approval_status', 'declined') !!}

                               <button class="btn waves-effect waves-light" type="submit" name="action">Decline</button>
                           
                           {!! Form::close() !!}
          </div>
    </div>
   
               
  </div>
          <!-- endmodal -->

@endsection

