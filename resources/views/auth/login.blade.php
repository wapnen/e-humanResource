@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col m8 offset-m2">
        <div class="section">
            
        
            <div class="card">
                
                <div class="card-content">
                <span class="card-title blue-text">User authentication</span>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                            <div class="row">
                        <div class=" input-field col m12 {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email"  >E-Mail Address</label>

                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="  input-field col m12{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password"  >Password</label>

                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        
                            <div class="  col m6">
                                
                                  <p>
                                        <input type="checkbox"  id="remember " class="filled-in" name="remember"> Remember Me
                                     <label for="remember"> </label>
                                </p>
                            </div>
                        
                            <p>
                            <div class=" input-field col m12 offset-m4">
                                <button type="submit" class="btn">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>
                                       </div>
                               </p>
                               </div>
                                <div class="card-action">
                                    <a  href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            
                                </div>
                        
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
