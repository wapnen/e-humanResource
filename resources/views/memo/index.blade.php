@extends('layouts.app')
@section('content')
	<div class="section">
		<div class="row">
			<div class="col m8 offset-m3">
				<div class="card">
					<div class="card-content">
					<span class = "card-title teal-text">Memos</span>
					<div class="row">
					    <div class="col s12">
					      <ul class="tabs">
					        <li class="tab col s3"><a href="#test1">Sent Memos</a></li>
					        <li class="tab col s3"><a class="active" href="#test2">Inbox</a></li>
					      </ul>
					    </div>
					    <div id="test1" class="col s12">
					    	<table>
							<thead>
								<tr>
								<th>Subject</th>
								<th>Date Sent</th>
								<th>Read memo</th>
								
								</tr>
							</thead>
							<tbody>
							@foreach($memos as $memo)
								<tr>
									<td>{{$memo->subject}}</td>
									<td>{{$memo->created_at}}</td>
									<td><a class="btn btn-primary" href="{{route('memopdf' , $memo->id)}}"><i class="fa fa-eye center"></a></td>
									</tr>
							@endforeach	
							</tbody>
						</table>
					    </div>
					    <div id="test2" class="col s12">
					    	<table>
							<thead>
								<tr>
								<th>Subject</th>
								<th>Date Received</th>
								<th>Read memo</th>
								
								</tr>
							</thead>
							<tbody>
							@foreach($received as $memo)
								@foreach($allmemos as $allmemo)
									@if($allmemo->id == $memo->memo_id)
									<tr>
									<td>{{$memo->subject}}</td>
									<td>{{$memo->created_at}}</td>
									<td><a class="btn btn-primary" href="{{route('memopdf' , $memo->id)}}"><i class="fa fa-eye center"></a></td>
									</tr>
									@endif
									@endforeach
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