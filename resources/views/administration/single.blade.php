@extends('layouts.app')

@section('content')


  <div class="section">
         <div class="row">
           
               

           <div class="col s12 m8 offset-m3">

            <div class="card ">
              <div class="card-content">
                  <span class = "card-title teal-text">Request Details </span>
              
             <table class="bordered">
               <thead>
                 <tr>
                   <th>Venue</th>
                   <th>Duration(days)</th>
                   <th>Authorization status</th>
                   <th>Approval status</th>
                   
                 </tr>
               </thead>
               <tbody>
                
                 
                    <tr>
                      <td>{{$fid->venue}}</td>
                      <td>{{$fid->duration}}</td>
                      <td>{{$fid->submition_status}}</td>
                      <td>{{$fid->approval_status}}</td>
                    </tr>
                 
                
               </tbody>
             </table>
             <div class="section">
               <table class="bordered">
               <thead>
                 <tr>
                   <th>Date(s)</th>
                   <th>Time(s)</th>
                   
                 </tr>
               </thead>
               <tbody>
                
                 @foreach($fidays as $fiday)
                    <tr>
                      <td>{{$fiday->date}}</td>
                      <td>{{$fiday->time}}</td>
                    </tr>
                 @endforeach
                
               </tbody>
             </table>
             
             </div>

              </div>
              <div class="card-action"><a  href="{{route('facility.index')}}" class=" modal-action modal-close waves-effect waves-green btn-flat">Back</a>
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
              @if($fid->submition_status == "Pending authorization")
             
         <div class="col s4 offset-s5">
                <div class="row">
                  <div class="col s6"><a class="waves-effect waves-light btn modal-trigger" href="#modal1">Decline</a> </div>  
                  <div class="col s6">{!! Form::open(array('route'=>['facility.update',$fid->id],'method'=>'patch'))!!}
                                      {!! Form::hidden('status', 'authorized by the department and pending approval from Administration ') !!}
                                      {!! Form::hidden('approval_status', 'Pending approval') !!}
                               <button class="btn waves-effect waves-light" type="submit" name="action">Authorize</button>
                           {!! Form::close() !!}</div>
                </div> 
                </div>
                 
                 @else
                 @if($fid->approval_status == "Pending approval" && Auth::user()->department_id == 4)
                     <div class="col s4 offset-s5">
                <div class="row">
                  <div class="col s6"><a class="waves-effect waves-light btn modal-trigger" href="#modal2">Decline</a> </div>  
                  <div class="col s6">{!! Form::open(array('route'=>['facility.update',$fid->id],'method'=>'patch'))!!}
                                      
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
                            {!! Form::open(array('route'=>['facility.update',$fid->id],'method'=>'patch'))!!}
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
                            {!! Form::open(array('route'=>['facility.update',$fid->id],'method'=>'patch'))!!}
                              
                              {!! Form::textarea('comment' ) !!}
                              {!! Form::hidden('status', 'declined') !!}}
                              {!! Form::hidden('approval_status', 'declined') !!}}

                               <button class="btn waves-effect waves-light" type="submit" name="action">Decline</button>
                           
                           {!! Form::close() !!}
          </div>
    </div>
   
               
  </div>
          <!-- endmodal -->

@endsection

