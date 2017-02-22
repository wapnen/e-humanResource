@extends('layouts.app')
@section('content')
	<div class="section">
	<div class="row">
		
	
		<div class="col s8 offset-s3">
			<div class="card">
			<div class="card-content">
				<span class = "card-title blue-text">Meetings</span>
				<div class="row">
					<table class="bordered">
               <thead>
                 <tr>
                   <th>Title</th>
                  
                   <th>Type</th>
                   
                   <th>Venue</th>
                   <th>Date</th>
                   <th>Time</th>
                   <th>View</th>
                 </tr>
               </thead>
               <tbody>
                @foreach($meetings as $meeting)
                   <tr>
                     <td>{{$meeting->title}}</td>
                     <td>{{$meeting->type}}</td>
                     <td>{{$meeting->venue}}</td>
                     <td>{{$meeting->date}}</td>
                     <td>{{$meeting->time}}</td>
                     <td><a class = "btn" href="{{route('meeting.show',$meeting->id)}}"><i class="fa fa-eye center"></i></a></td>
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