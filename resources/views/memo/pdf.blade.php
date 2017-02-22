<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style type="text/css">
      .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
}

#logo img {
  width: 150px;
  height: 150px;
}

h2 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 50 -50px 20px 0;
  background: url(dimension.png);
}

#project {
  float: left;
}

#project #company span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 1.0em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap; 
  margin-right: 50px;       
}

table {
  width: 90%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
  margin-top: 25px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="C:\Users\dirnen\Desktop\wap\fyp\laraveldocman\public\css\images\logo.jpg"/>
        <h3>Valley View University </h3>  <h4>PMB KIA 9358, Airport Accra Ghana</h4>
       <h5><span>Location:</span>Oyibi, Accra Dodowa Road</h5>
      </div>
      <h2>MEMO </h2>
      
      <div id="company" class="clearfix">
        <div><span>TO: </span> @foreach($memoreceipient as $receipient) 
            @foreach($users as $user)
              @if($user->id == $receipient->receipient)
                {{$user->name}} ({{$user->role}}) <br/> 
              @endif
            @endforeach
         @endforeach </div>
        
        </div>
      <div id="project">
        <div><span>FROM: </span>  @foreach($users as $user)
              @if($user->id == $memo->user_id)
                {{$user->name}} ({{$user->role}}) </br>
              @endif
            @endforeach</div>
        <div><span>DATE: </span> {{$memo->created_at}}</div>
        
      </div>
    </header>
    <main>
        
      <div style="margin-top: 50px; margin-right: 50px;">
      <div style="text-align: center"><h4><span>RE:</span> {{$memo->subject}}</h4></div>
        @foreach($memobody as $body)
        <p>{{$body->paragraph}}</p>
      @endforeach  
      </div>
      
    </main>
    <footer>
     Memo was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>