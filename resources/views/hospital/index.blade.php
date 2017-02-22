@extends('layouts.app')
@section('content')
	<div class="section">
	<div class="row">
		
	
		<div class="col s8 offset-s3">
			<div class="card">
			<div class="card-content">
				<span class = "card-title blue-text">Hospital Bills</span>
				<div class="row">
					<table class="bordered">
               <thead>
                 <tr>
                   <th>Patient name</th>
                  
                   <th>Folder No.</th>
                   
                   <th>Account type</th>
                   <th>Account code</th>
                   <th>Date</th>
                   
                 </tr>
               </thead>
               <tbody>
                @foreach($healthcharges as $healthcharge)
                   <tr>
                     <td>{{$healthcharge->patient_name}}</td>
                     <td>{{$healthcharge->folder_no}}</td>
                     <td>{{$healthcharge->account_type}}</td>
                     <td>{{$healthcharge->account_code}}</td>
                     <td>{{$healthcharge->created_at}}</td>
                     <td><a class = "btn" href="{{route('healthcharge.show',$healthcharge->id)}}"><i class="fa fa-eye center"></i></a></td>
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