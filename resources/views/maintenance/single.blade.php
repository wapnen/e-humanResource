@extends('layouts.app')

@section('content')


  <div class="section">
         <div class="row">
           
               

           <div class="col s12 m9 offset-m3">

            <div class="card ">
              <div class="card-content">
                  <span class = "card-title teal-text">Request Details </span>
              
              <table class="bordered">
               
               <tbody>
        
                    <td>Facility</td> <td>{{$maintenance->facility_name}}</td></tr>
                     <tr><td>Specific location</td><td>{{$maintenance->location}}</td></tr>
                     <tr><td>Type of work</td><td>{{$maintenance->type}}</td></tr>
                     <tr><td>Category</td><td>{{$maintenance->subtype}}</td></tr>
                     <tr><td>Description</td><td>{{$maintenance->description}}</td></tr>
                     <tr><td>Approval status(HOD)</td><td>{{$maintenance->submit_status}}</td></tr>
                     <tr><td>Confirmation status (Director of Works)</td><td>{{$maintenance->approval_status}}</td></tr>
                     <tr><td>Requested on</td><td>{{$maintenance->created_at}}</td></tr>
                      <tr><td>Requested By</td>@foreach($user as $use)<td>{{$use->name}}</td>@endforeach</tr>
                 
       
               </tbody>
             </table>
             
              </div>
              <div class="card-action"><a  href="{{route('maintenance.index')}}" class=" modal-action modal-close waves-effect waves-green btn-flat">Back</a>
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
              @if($maintenance->submit_status == "Pending authorization")
             
         <div class="col s4 offset-s5">
                <div class="row">
                  <div class="col s6"><a class="waves-effect waves-light btn modal-trigger" href="#modal1">Decline</a> </div>  
                  <div class="col s6">{!! Form::open(array('route'=>['maintenance.update',$maintenance->id],'method'=>'patch'))!!}
                                      {!! Form::hidden('status', 'authorized by the department and pending confirmation from Works department ') !!}
                                      {!! Form::hidden('approval_status', 'Pending confirmation') !!}
                               <button class="btn waves-effect waves-light" type="submit" name="action">Authorize</button>
                           {!! Form::close() !!}</div>
                </div> 
                </div>
                 
                 
                 
                @endif
                @endif
                @if($maintenance->approval_status == "Pending confirmation")
                     <div class="col s4 offset-s5">
                <div class="row">
                  <div class="col s6"><a class="waves-effect waves-light btn modal-trigger" href="#modal2">Decline</a> </div>  
                  <div class="col s6">{!! Form::open(array('route'=>['maintenance.update',$maintenance->id],'method'=>'patch'))!!}
                                      
                                      {!! Form::hidden('status', 'Approved!') !!}
                                      {!! Form::hidden('approval_status', 'Approved!') !!}
                               <button class="btn waves-effect waves-light" type="submit" name="action">Authorize</button>
                           {!! Form::close() !!}</div>
                </div> 
                </div>
                @endif
         </div>
       </div>

       <!-- modal -->
       <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Reject request</h4>
          <div class="row">
                            {!! Form::open(array('route'=>['maintenance.update', $maintenance->id],'method'=>'patch'))!!}
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
                            {!! Form::open(array('route'=>['maintenance.update',$maintenance->id],'method'=>'patch'))!!}
                              
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

