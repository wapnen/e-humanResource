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
    
     <h4 id="dept">Human Resource Department</h4>
    @endif 
     <h4></h4>	
	</div>
	<div class="row">
		<div class="col s8 offset-s3">
			
            <table class="bordered">
      
          <caption>Leave applications</caption>
              <table>
              <thead>
                <tr>
                <th>Days entitled</th>
                <th>Outstanding days</th>
                <th>Days taken</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Money Entitled</th>
                @if(Auth::user()->role == 'HOD' || Auth::user()->role == 'deputy registrar' || Auth::user()->role == 'finance officer')
                <th>Requesting Officer</th>
                @endif
                @if( Auth::user()->role == 'deputy registrar' ||  Auth::user()->role == 'finance officer')
                <th>Department</th>
                @endif
                
                </tr>
              </thead>
              <tbody>
                @foreach($leave as $leave)
                  <tr>
                    <td>{{$leave->days_entitled}}</td>
                    
                    <td>{{$leave->outstanding_leave}}</td>
                    <td>{{$leave->days_taken}}</td>
                    <td>{{$leave->from}}</td>
                    <td>{{$leave->to}}</td>
                    <td>{{$leave->money_entitled}}</td>
                    @if(Auth::user()->role == 'HOD' || Auth::user()->role == 'finance officer' || Auth::user()->role == 'deputy registrar')
                        @foreach($users as $user)
                        @if($user->id == $leave->user_id)
                        <td>{{$user->name}}</td>
                        @if(Auth::user()->role == 'finance officer' || Auth::user()->role == 'deputy registrar')
                        
                        @foreach($departments as $department)
                          @if($department->id == $leave->department_id)
                          <td>{{$department->name}}</td>
                          @endif
                        @endforeach


                        @endif
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