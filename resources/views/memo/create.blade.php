@extends('layouts.app')
@section('content')
      <div class="section">
      <div class="row">
      <div class="col s8 offset-s3">
            

            <div class="card ">
                  <div class="card-content">
                        <span class = "card-title blue-text">New Memo</span>
             <div class="row">
            <form class="col s12" method="POST" action="{{ route('memo.store') }}">
                        {{ csrf_field() }}
                        <div class="row">
                       
                        <div class="input-field col s12">
                              <label for="subject">Message Subject:</label>
                              <input type="text" name="subject">     
                              <span class="red-text">{{$errors->first('title',':message')}}</span>
                        </div>
                        
                        <div id="paragraph">

                        </div>
                        
                      <div class="section">
                                    
                              <div class="row">
                                    <div class="col m6 offset-m3">
                                    <a class = "btn btn-primary" id = "addparagraph">Add paragraph</a>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                              </div>
                              </div>
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