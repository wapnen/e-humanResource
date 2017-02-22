@extends('layouts.app')
@section('content')
<div class="section">
	<div class="row">
	<div class="col s8 offset-s3">
		

		<div class="card ">
			<div class="card-content">
				<span class = "card-title blue-text">Invite users</span>
		 <div class="row">
    		<form class="col s12" method="POST" action="{{ route('member.store') }}">
                        {{ csrf_field() }}
      			<div class="row">
                        <table>
                        <thead>
                              <th>Select</th>
                              <th>Name</th>
                              <th>Department</th>
                              <th>Role</th>
                        </thead>
                              @foreach($users as $user)
                                    <tr><td>
                                          <input type="checkbox" id="user{{$user->id}}" name="{{$user->id}}" />
                                          <label for="user{{$user->id}}"></label>
                                        </td>
                                    <td>{{$user->name}}</td>
                                    @foreach($dept as $dep)
                                          @if($dep->id == $user->department_id)<td>{{$dep->name}}</td>@endif
                                    @endforeach
                                    <td>{{$user->role}}</td>
                                    </tr>
                              @endforeach
                         </table>     
      	     		<div class="input-field col s6 offset-s5">
                              <button class="btn btn-primary">Invite</button>
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