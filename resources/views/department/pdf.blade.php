<<!DOCTYPE html>
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
    padding: 8px;
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
		 @if(Auth::user()->department_id !=4)
     <h4 id="dept">Department of {{$dept->name}}</h4>
		 @else
     <h4 id="dept">General Administration</h4>
     @endif
     <h4></h4>	
	</div>
	<div class="row">
		<div class="col s8 offset-s3">
			<table class="bordered">
			<caption>Use of University facility report</caption>
               <thead>
                 <tr>
                   <th>Meeting Venue</th>
                  
                   <th>Meeting type</th>
                   <th>Duration</th>
                   <th>Authorization status</th>
                   <th>Approval status</th>
                   <th>Request date</th>
                   <th>Requesting officer</th>
                   <!-- @if(Auth::user()->department_id == 4)
                   <th>Department</th>
                   @endif -->
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
                     <td>{{$facility->created_at}}</td>
                     @foreach($users as $user)
                     	@if($user->id == $facility->user_id)
                     <td>{{$user->name}}</td>
                     @endif
                     @endforeach
                     <!-- @if(Auth::user()->department_id == 4)
                          @foreach($dept as $depts)
                            @if($depts->id == $user->department_id)
                              <td>{{$depts->name}}</td>
                            @endif
                          @endforeach
                     @endif   -->                    
                   </tr>
                @endforeach
               </tbody>
             </table>

		</div>
	</div>
</div>
</body>
</html>