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
		 @if(Auth::user()->department_id !=7)
    
     <h4 id="dept">Works and Physical Development</h4>
    @endif 
     <h4></h4>	
	</div>
	<div class="row">
		<div class="col s8 offset-s3">
			
            <table class="bordered">
      
          <caption>Maintenance requests</caption>
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
                   <th>Requested by</th>
                   
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
                     @foreach($users as $use)
                        @if($use->id == $maintain->user_id)
                          <td>{{$use->name}}</td>
                        @endif  
                     @endforeach
                   </tr>
                @endforeach
               </tbody>

		</div>
	</div>
</div>
</body>
</html>