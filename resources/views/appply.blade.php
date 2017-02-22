@extends('layouts.app')

@section('content')
  <div class="section">
         <div class="row">
          <div class=" card-panel teal col 12 offset-s6">
                
           <span class="card-title flow-text large center"> My Applications</span>
              </div>
           <div class="col s12 m9 offset-m3 blue-grey lighten-5">
          
           <div class="card-panel ">
              
           <div class="row">
           <!-- start tab -->

                <div class="col s12">
                  <ul class="tabs">
                    <li class="tab col s3"><a class="active"href="#test1">Facility Requests</a></li>
                    <li class="tab col s3"><a  href="#test2">Test 2</a></li>
                    <li class="tab col s3 "><a href="#test3">Disabled Tab</a></li>
                    <li class="tab col s3"><a href="#test4">Test 4</a></li>
                  </ul>
                </div>
                <!-- facility request tab -->
                <div id="test1" class="col s12">
                  <table class="bordered">
               <thead>
                 <tr>
                   <th>Meeting Venue</th>
                  
                   <th>Meeting type</th>
                   <th>Duration</th>
                   <th>Authorization status</th>
                   <th>Approval status</th>
                   <th>Details</th>
                   <th>Delete</th>
                 </tr>
                 
               </thead>
               <tbody>
              <!--   @foreach($facilities as $facility)
                   <tr>
                     <td>{{$facility->venue}}</td>
                     <td>{{$facility->type}}</td>
                     <td>{{$facility->duration}}</td>
                     <td>{{$facility->submition_status}}</td>
                     <td>{{$facility->approval_status}}</td>
                     <td><a class = "btn" href="{{route('facility.show',$facility->id)}}"><i class="fa fa-eye center"></i></a></td>
                    <td>{!! Form::open(array('route'=>['facility.destroy',$facility->id],'method'=>'delete'))!!}
                               <button class="btn waves-effect waves-light" type="submit" name="action">
                                <i class="fa fa-trash center"></i>
                               </button>
                           {!! Form::close() !!}
                           </td>
                   </tr>
                @endforeach -->
               </tbody>
             </table>
                </div>
                <!-- end facility request tab -->
                <div id="test2" class="col s12">Test 2</div>
                <div id="test3" class="col s12">Test 3</div>
                <div id="test4" class="col s12">Test 4</div>
              </div>
              <!--end tab-->
                    </div>
             
           </div>
           <div id="modal1" class="modal">
              <div class="modal-content">
                
                <p>Are you sure you want to delete this request?</p>
              </div>
              <div class="modal-footer">
                <a href="applications.php?confirm=delete" class=" modal-action modal-close waves-effect waves-green btn-flat">Yes</a>
                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">No</a>
              </div>
            </div>
         </div>
       </div>
@endsection