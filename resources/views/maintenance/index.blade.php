@extends('applications')
@section('appcontent')

<div class="section">
	<div class="row">
		
	
		<div class="col s9 offset-s3">
			<div class="card">
			<div class="card-content">
				<span class = "card-title blue-text">Maintenance requests</span>
				<div class="row">
					<table class="bordered">
               <thead>
                 <tr>
                   <th>Facility</th>
                  
                   <th>Specific Location</th>
                   
                   <th>Type of work</th>
                   <th>category</th>
                   <th>Description</th>
                   <th>Approval status</th>
                   <th>Authorization status</th>
                   <th>Requested on</th>
                   <th>Details</th>
                   
                 </tr>
               </thead>
               <tbody>
                @foreach($maintenance as $maintain)
                   <tr>
                     <td>{{$maintain->facility_name}}</td>
                     <td>{{$maintain->location}}</td>
                     <td>{{$maintain->type}}</td>
                     <td>{{$maintain->subtype}}</td>
                     <td>{{$maintain->description}}</td>
                     <td>{{$maintain->submit_status}}</td>
                     <td>{{$maintain->approval_status}}</td>
                     <td>{{$maintain->created_at}}</td>
                     <td><a class = "btn" href="{{route('maintenance.show',$maintain->id)}}"><i class="fa fa-eye center"></i></a></td>
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
@endsection