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
		 
     <h4 id="dept">Invoice</h4>
     
     <h4></h4>	
	</div>
	<div class="row">
		<div class="col s8 offset-s3">
			<table class="bordered">
              <tr>
                <th>Patient Name</th>
                <td>{{$healthcharge->patient_name}}</td>
              </tr>
              <tr>
                <th>Folder Number</th>
                <td>{{$healthcharge->folder_no}}</td>
              </tr>
              <tr>
                <th>Account Code</th>
                <td>{{$healthcharge->account_code}} ({{$healthcharge->account_type}})</td>
              </tr>
              <tr>
                <th>Total(GHc)</th>
                <td>{{$healthcharge->total}}</td>
              </tr>
             

            </table>

              <table>
              <caption>Breakdown</caption>
                  <thead>
                    <tr>
                    <th>Service(s)</th>
                    <th>Cost(GHc)</th>
                    </tr>
                  </thead>
                  <tbody>
                @foreach($healthservices as $healthservice)
                  <tr>
                    <td>{{$healthservice->type}}</td>
                    <td>{{$healthservice->ammount}}</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
		</div>
	</div>
</div>
</body>
</html>