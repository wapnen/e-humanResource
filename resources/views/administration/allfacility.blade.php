@extends('applications')
@section('appcontent')

<div class="section">
	<div class="row">
		

		<div class="col s8 offset-s3">
			<div class="card">
			<div class="card-content">
				<span class = "card-title blue-text">Facility requests</span>
				<div class="row">
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
                @foreach($facilities as $facility)
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
                @endforeach
               </tbody>
             </table>
            </div>
            </div>
            </div>
            </div>
		</div>
	</div>
</div>
  
@endsection