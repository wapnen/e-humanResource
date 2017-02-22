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
    
     <h4 id="dept">Procurement Department</h4>
    @endif 
     <h4></h4>	
	</div>
	<div class="row">
		<div class="col s8 offset-s3">
			
            <table class="bordered">
      
          <caption>Purchase requests</caption>
              <table>
              <thead>
                <tr>
                <th>Delivery site</th>
                <th>Approval status (HOD)</th>
                <th>Approval status (Procurement)</th>
                @if(Auth::user()->role == 'HOD' || Auth::user()->role == 'finance officer')
                <th>Requesting Officer</th>
                @endif
                
                <th>Total</th>
                <th>Date requested</th>
                </tr>
              </thead>
              <tbody>
                @foreach($purchase as $purchase)
                  <tr>
                    <td>{{$purchase->delivery_site}}</td>
                    
                    <td>{{$purchase->authorized}}</td>
                    <td>{{$purchase->approved}}</td>
                    @if(Auth::user()->role == 'HOD' || Auth::user()->role == 'finance officer')
                        @foreach($users as $user)
                        @if($user->id == $purchase->user_id)
                        <td>{{$user->name}}</td>
                        @if(Auth::user()->role == 'finance officer')
                        
                        @endif
                        @endif
                        
                        @endforeach
                    @endif
                    <td>{{$purchase->total}}</td>
                    <td>{{$purchase->created_at}}</td>
                    
                      </tr>
                    @endforeach
              </tbody>
		</div>
	</div>
</div>
</body>
</html>