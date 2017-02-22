<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>VVU</title>

<!--  <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
       -->  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/materialize.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('css/font-awesome.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('css/sweetalert.css')}}">
         <script src= "{{URL::asset('js/jquery-3.1.1.min.js')}}"></script>

        <script src= "{{URL::asset('js/sweetalert.min.js')}}"></script>
      
    
</head>
<body >
@include('sweet::alert')

    <header>
<ul id="dropdown1" class="dropdown-content">
  <li><a href="{{ url('/logout') }}">Logout</a></li>
 
</ul>
<nav class="top-nav fixed">
      <div class="nav-wrapper blue fixed"><a href="#" data-activates="nav-mobile" class="button-collapse show-on-large"><i class="mdi-navigation-menu"></i></a>
        <ul class="right hide-on-med-and-down">
       
        @if (Auth::guest())
                        <li class="white-text"><a href="{{ url('/login') }}">Login</a></li>
                        

                    @else
                      @if(Auth::user()->role == 'HOD')
                        <li><a href="{{route('department.index')}}">My Department</a></li>
                      @endif
                      @if(Auth::user()->role == 'Cashier')
                        <li><a href="{{route('healthcharge.index')}}">Manage Books</a></li>
                      @endif
                      @if(Auth::user()->role == 'finance officer')
                       <li><a href="{{route('finance.index')}}">Manage Books</a></li>
                      @endif
                      @if(Auth::user()->role == 'director of transport')
                       <li><a href="{{route('transporthome')}}">Manage Requests</a></li>
                      @endif
                      @if(Auth::user()->role == 'procurement officer')
                       <li><a href="{{route('purchase.index')}}">Manage Requests</a></li>
                      @endif


                     <!-- Dropdown Trigger -->

              <li><a class="dropdown-button" href="#!" data-activates="dropdown1">{{ Auth::user()->name }}<i class="fa fa-btn fa-sign-out"></i></a></li>
      @endif

      </ul>

      </nav> 

  <ul id="nav-mobile" class="side-nav fixed white">
       
        <li class="logo"><img href="{{url('/')}}" class="waves-effect waves-teal"><img src="{{URL::asset('css/images/logo.jpg')}}"></a></li>
        @if (Auth::user() && Auth::user()->department_id != 8)
          <li><a href="{{url('/')}}">Home  <i class="fa fa-lg fa-home"></i></a></li>
           <li><a href="{{route('leave.create')}}">Apply for leave  <i class="fa fa-lg fa-road"></i></a></li>
                  <li><a href="{{route('food.create')}}">Apply for food  <i class="fa fa-lg fa-cutlery"></i></a></li>
                  <li><a href="{{route('maintenance.create')}}">Maintenance request <i class="fa fa-lg fa-wrench"></i></a></li>
                  <li><a href="{{route('transport.create')}}">Apply for transport <i class="fa fa-lg fa-bus"></i></a></li>
                  <li><a href="{{route('purchase.create')}}">Requisition  <i class="fa fa-lg fa-shopping-cart"></i></a></li>
                  <li><a href="{{route('facility.create')}}">Apply for facility <i class="fa fa-lg fa-university"></i></a></li>
                  
        @endif
        </ul>
        </div>
        </header>
        
    @yield('content')
   
    @yield('health')
   
</body>

<script src= "{{URL::asset('js/bootstrap.min.js')}}"></script>

   
      
</html>
