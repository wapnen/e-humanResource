@extends('layouts.app')
@section('content')
      <div class="section">
      <div class="row">
      <div class="col s8 offset-s3">
         <div class="card-panel yellow darken-1">
               <h4 class="center purple-text darken-4">NOTICE BOARD</h4>
         </div>   

  <ul class="collapsible popout" data-collapsible="accordion">
    @foreach($notices as $notice)
    <li>
      <div class="collapsible-header active">{{$notice->title}}</div>
      <div class="collapsible-body teal lighten-2"><p class="flow-text">{{$notice->body}}</p></div>
    </li>
    @endforeach
  </ul>
        
            </div>
                  </div>
            </div>
@endsection