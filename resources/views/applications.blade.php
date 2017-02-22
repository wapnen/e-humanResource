@extends('layouts.app')

@section('content')
  <div class="section">
      <div class="row">
        <div class="col s7 offset-s4">
         
             
            
             <form class="col s12" method="POST" action="/allapplications">
                        {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s8">
                   
                      <select name = "type" class="browser-default">
                        <option value ="" disabled selected>Select Application type</option>     
                        <option value="1" >Use of university facility</option>
                        <option value="2">Food request</option>
                        <option value="3"> Maintenance requests</option>
                        <option value="4">Transport requests </option>
                        <option value="5">Purchase requests</option>
                        <option value="6">Leave applications</option>
                      </select>
                      
                </div>
                <div class="input-field col s4">
                        <button class="btn primary" name="submit">View</button>
                      </div>
              </div>
            </form>
          
        </div>
      </div>    
      @yield('appcontent')
        </div>
@endsection