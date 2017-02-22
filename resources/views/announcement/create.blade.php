@extends('layouts.app')
@section('content')
      <div class="section">
      <div class="row">
      <div class="col s8 offset-s3">
            

            <div class="card ">
                  <div class="card-content">
                        <span class = "card-title blue-text">Post Notice</span>
             <div class="row">
            <form class="col s12" method="POST" action="{{ route('announcement.store') }}">
                        {{ csrf_field() }}
                        <div class="row">
                        <div class="input-field col s6">
                              <label for="title">
                                    Title:
                              </label>
                              <input type="text"  name="title">      
                              <span class="red-text">{{$errors->first('title',':message')}}</span>
                        </div>
                        <div class="input-field col s6">
                              <!-- <label for="expiry_date">
                                    Delivery date:
                              </label> -->
                              <input type="date"  name="expiry_date" placeholder ="expiry date">  
                              <span class="red-text">{{$errors->first('expiry_date',':message')}}</span>
                        </div>
                        <div class="input-field col s12">
                              <textarea id="body" name="body" class="materialize-textarea"></textarea>
                        <label for="body">Body:</label>
                        <span class="red-text">{{$errors->first('body',':message')}}</span>
                        </div>
                        
                       <div class="col s5 offset-s5"> 
                             <h5>Post To:</h5>
                       </div>
                        
                       
                        <div class="input-field col s4">
                              <input type="checkbox" id="test5" name="all" />
                              <label for="test5">All Departments</label>      
                        </div>

                        @foreach($departments as $department)
                              <div class="input-field col s4">
                              <input type="checkbox" class="departments" id = "{{$department->id}}" name="{{$department->id}}" />
                              <label for="{{$department->id}}">{{$department->name}}</label>      
                              </div>
                        @endforeach

                        <span class="red-text">{{$errors->first('type',':message')}}</span>
                        <div class="card-action col s12 offset-s5">
                              <button class="btn waves-effect waves-light" type="submit" name="action">Submit </button>
                        </div>
                        </div>      
                        
                  </form>           
            </div>            
      </div>      
      </div>
                  </div>
                  </div>
            </div>
@endsection