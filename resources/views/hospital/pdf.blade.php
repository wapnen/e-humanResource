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
		<h1 id="vvu">Valley View University Hospital</h2>
		 
     <h4 id="dept">Hospital Charges Report</h4>
     
     <h4></h4>	
	</div>
	<div class="row">
		<div class="col s8 offset-s3">
			<table class="bordered">
               <thead>
                 <tr>
                   <th>Patient name</th>
                  
                   <th>Folder No.</th>
                   
                   <th>Account type</th>
                   <th>Account code</th>
                   <th>Total</th>
                   @if(Auth::user()->department_id == 8 && Auth::user()->role == "Cashier")
                   <th>Cheque status</th>
                   @elseif(Auth::user()->department_id == 5 && Auth::user()->role == "finance officer")
                   <th>Status</th>
                   @endif
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
                     <td>GHc {{$healthcharge->total}}</td>
                     @if(Auth::user()->department_id == 8 && Auth::user()->role == "Cashier")
                   <td>{{$healthcharge->recieved}}</td>
                   @elseif(Auth::user()->department_id == 5 && Auth::user()->role == "finance officer")
                   <td>{{$healthcharge->deducted}}</td>
                   @endif
                     <td>{{$healthcharge->created_at}}</td>
                     
                   </tr>
                @endforeach
               </tbody>
             </table>
		</div>
	</div>
</div>
</body>
</html>