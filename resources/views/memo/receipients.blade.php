@extends('layouts.app')
@section('content')
      <div class="section">
      <div class="row">
      <div class="col s8 offset-s3">
            

            <div class="card ">
                  <div class="card-content">
                        <span class = "card-title blue-text">Add Receipients</span>
             <div class="row">
                        <div class="row">
                       
                        <div class="input-field col s6 offset-s3">
                              <select class="browser-default" id="receipientType" name="type">
                                    <option value="" disabled selected>Select receipient type</option>
                                    <option value="dept">Department or Office</option>
                                    <option value="staff">Member of staff</option>
                              </select>      
                              <span class="red-text">{{$errors->first('title',':message')}}</span>
                        </div>
                    
                        
                       <form id="departmentdiv" class="col s12" method="POST" action="{{ route('storereceipient') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="memo_id" value="{{$memoid}}">
                        <input type="hidden" name="type" value="dept">
                        <div class="row">
                        <div class="input-field col s4">
                              <input type="checkbox" id="test5" name="alldepts" />
                              <label for="test5">All Departments</label>      
                        </div>
                              @foreach($departments as $department)
                              <div class="input-field col s4">
                              <input type="checkbox" class="departments" id = "{{$department->id}}" name="{{$department->id}}" />
                              <label for="{{$department->id}}">{{$department->name}}</label>      
                              </div> 
                              @endforeach
                        </div>

                         <div class="card-action col s12 offset-s5">
                              <button class="btn waves-effect waves-light" type="submit" name="action">Submit </button>
                        </div>
                        </form> 
                        <form id="userdiv" class="col s12" method="POST" action="{{ route('storereceipient') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="memo_id" value="{{$memoid}}">
                        <input type="hidden" name="type" value="users">
                        <div class="row">
                        <div class="input-field col s4">
                              <input type="checkbox" id="test6" name="allusers" />
                              <label for="test6">All Staff</label>      
                        </div>
                              @foreach($users as $user)
                              <div class="input-field col s4">
                              <input type="checkbox" class="users" id = "{{$user->id}}" name="{{$user->id}}" />
                              <label for="{{$user->id}}">{{$user->name}}</label>      
                              </div> 
                              @endforeach
                        </div>
                        
                         <div class="card-action col s12 offset-s5">
                              <button class="btn waves-effect waves-light" type="submit" name="action">Submit </button>
                        </div>
                        </form>  
                        </div>      
                          
            </div>            
      </div>      
      </div>
                  </div>
                  </div>
            </div>
@endsection