@extends('applications')
@section('appcontent')

	<div class="section">
	<div class="row">
		
	
		<div class="col s8 offset-s3">
			<div class="card">
			<div class="card-content">
				<span class = "card-title blue-text">Food requests</span>
				<div class="row">
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
                   <th>Details</th>
                   
                 </tr>
               </thead>
               <tbody>
                @foreach($food as $feed)
                   <tr>
                     <td>{{$feed->purpose}}</td>
                     <td>{{$feed->people}}</td>
                     <td><ul class="collection">@foreach($type as $typ)
                     		@if($typ->food_id == $feed->id)

                     			<li class="collection-item">{{$typ->type}}</li>
                     		@endif
                     @endforeach</ul></td>
                     <td>{{$feed->delivery_date}}</td>
                     <td>{{$feed->submit_status}}</td>
                     <td>{{$feed->approval_status}}</td>
                     <td>{{$feed->created_at}}</td>
                     <td><a class = "btn" href="{{route('food.show',$feed->id)}}"><i class="fa fa-eye center"></i></a></td>
                   </tr>
                @endforeach
               </tbody>
             </table>
				</div>
			</div>
      @if(Auth::user()->role == "finance officer")
      <div class="card-action">
        <a href="{{route('finance.index')}}">Back</a>
      </div>
      @endif
		</div>
		</div>
	</div>
</div>
@endsection