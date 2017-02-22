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
     @foreach($dept as $dept)
     <h4 id="dept">Department of {{$dept->name}}</h4>
		 @endforeach
     @else
     <h4 id="dept"></h4>
     @endif
     <h4></h4>	
	</div>
	<div class="row">
		<div class="col s8 offset-s3">
			<table class="bordered">
			<caption>Use of University facility report</caption>
               <thead>
                 <tr>
                   <th>Venue</th>
                   <th>Duration(days)</th>
                   <th>Authorization status</th>
                   <th>Approval status</th>
                 </tr>
               </thead>
               <tbody>
                
                 
                    <tr>
                      <td>{{$fid->venue}}</td>
                      <td>{{$fid->duration}}</td>
                      <td>{{$fid->submition_status}}</td>
                      <td>{{$fid->approval_status}}</td>
                    </tr>
                 
                
               </tbody>
             </table>

		</div>
	</div>
</div>
</body>
</html>