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
		<h1 id="vvu">Valley View University </h2>
		 
     <h4 id="dept">Transport Report</h4>
     
     <h4></h4>	
	</div>
	<div >
		<div >
    <table>
			<thead>
        <tr>
                <th>Purpose</th>
                <th>Destination</th>
                
                <th>Service</th>
                <th>Authorization status</th>
                <th>Approval status</th>
                @if(Auth::user()->role == "director of transport" || Auth::user()->role == "HOD")
                  <th>Requesting officer</th>
                @endif
                @if(Auth::user()->role == "director of transport" )
                  <th>Department</th>
                @endif
                <th>Date</th>
                </tr>
              </thead>
              <tbody>
                @foreach($transport as $trans)
                <tr>
                    <td>{{$trans->purpose}}</td>
                    <td>{{$trans->destination}}</td>
                    <td>{{$trans->type_of_service}}</td>
                    <td>{{$trans->authorized}}</td>
                    <td>{{$trans->approved}}</td>
                    @if(Auth::user()->role == "director of transport" || Auth::user()->role == "HOD")
                      @foreach($users as $user)
                        @if($user->id == $trans->user_id)
                          <td>{{$user->name}}</td>
                          @foreach($departments as $department)
                            @if($user->department_id == $department->id && Auth::user()->role == "director of transport")
                              <td>{{$department->name}}</td>
                            @endif
                          @endforeach
                        @endif
                      @endforeach

                    @endif
                    <td>{{$trans->created_at}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
		</div>
	</div>
</div>
</body>
</html>