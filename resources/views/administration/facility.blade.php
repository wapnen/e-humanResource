@extends('layouts.app')

@section('content')
		
			<div class="section">
          <div class="row">
            <div class="col s12 m8 offset-m3">
              <div class="card">
                <div class="card-content">
                <span  class = "card-title blue-text">Use of University Facility</span>
                <form id = "facility_request" method="post" action="{{ route('facility.store') }}">
                {{ csrf_field() }}
                <div class="row">
                  <div class="input-field col s12">
                    <label for="venue">Meeting venue:</label>
                    <input type="text" name="venue" required/>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s6">
                    <select class="browser-default" name="type">
                    <label>Type of Meeting</label>
                      <option value="commitee">Committee meeting</option>
                      <option value="seminar">Seminar</option>
                      <option value="conference">Conference</option>
                    </select>
                  </div>
                  <div class="input-field col s6">
                    <label for="duration">Duration</label>
                    <input type="text" id = "duration" name = "duration" placeholder = "No. of days" required/>
                    @if ($errors->has('duration')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s6 offset-s5">
                    <button class="btn waves-light " type="submit" name="submit" >Submit</button>
                  </div>
                </div>
                </form>
              </div>
              </div>
            </div>
          </div>
        </div>
@endsection

  