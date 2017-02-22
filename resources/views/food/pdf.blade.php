<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		table {
    border-collapse: collapse;
    width: 100%;
    border-style: dashed;
    border-width: 0.5px;
    margin-top: 50px;
}

th, td {
    padding: 4px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}	

#vvu{
		text-align: center;
		margin-left: 35px;
		margin-top: -120px;
	}
#dept{

	text-align: center;
	margin-left: 35px;
	margin-top: -5px;
}
	</style>


</head>
<body>
<div class="section">
	<div class="pdfheader">

		<img src="C:\Users\dirnen\Desktop\wap\fyp\laraveldocman\public\css\images\logo.jpg"/>
		<h1 id="vvu">Valley View University</h2>
		 @if(Auth::user()->department_id !=6)
     <h4 id="dept">Department of {{$dept->name}}</h4>
		@endif
     <h4 id="dept">Cafeteria</h4>
     
     <h4></h4>	
	</div>
	<div class="row">
		<div class="col s8 offset-s3">
			<table class="bordered">
			<caption>Food requests</caption>
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
                   @if(Auth::user()->department_id == 6)
                   <th>Department</th>
                   @endif
                   
                 </tr>
               </thead>
               <tbody>
               @foreach($food as $fid)
                   <tr>
                     <td>{{$fid->purpose}}</td>
                     <td>{{$fid->people}}</td>
                     <td>@foreach($type as $typ)
                        @if($typ->food_id == $fid->id)

                          {{$typ->type .","}} 
                        @endif
                     @endforeach</td>
                     <td>{{$fid->delivery_date}}</td>
                     <td>{{$fid->submit_status}}</td>
                     <td>{{$fid->approval_status}}</td>
                     <td>{{$fid->created_at}}</td>
                     
                     @foreach($users as $user)
                        @if($user->id == $fid->user_id)
                        <td>{{$user->name}}</td>
                        @endif
                     @endforeach
                     @if(Auth::user()->department_id == 6)
                     @foreach($dept as $dep)
                        @if($dep->id == $fid->department_id)
                        <td>{{$dep->name}}</td>
                        @endif
                     @endforeach
                     @endif
                   </tr>
               @endforeach
               </tbody>
             </table>

		</div>
	</div>
</div>
</body>
</html>