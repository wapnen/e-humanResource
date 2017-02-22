@extends('layouts.app')

@section('content')
@if(Auth::user())
<div id = "welcome" class="section">
            
            <div class="row">
                <div class="col s4 offset-s3" style="margin-top: 50px;">
                    <div class="card large">
                     <div class="card-image">
                            <img src="{{URL::asset('css/images/rsz_1rsz_apply.png')}}">
                        </div>
                        <div class="card-content">
                            <span class = "card-title blue-text">My applications</span>
                            <p>You can view the status of your applications</p>
                        </div>
                        <div class="card-action">
                            <a href="{{route('applications.create')}}">View applications</a>
                        </div>
                    </div>
                </div>
                <div class="col s4">
                    <div class="card large">
                    <div class="card-image">
                            <img src="{{URL::asset('css/images/meeting.jpg')}}">
                        </div>
                        <div class="card-content">
                            <span class = "card-title blue-text">Meetings</span>
                            <p>Call a meeting and invite staff members </p>
                        </div>
                        <div class="card-action">
                            <a href="{{route('meeting.create')}}">Call meeting</a>
                            <a href="{{route('meeting.index')}}">View munites</a>
                        </div>
                    </div>
                </div>
            </div>
           <div class="row">
                <div class="col s4 offset-s3" >
                    <div class="card large">
                     <div class="card-image">
                            <img src="{{URL::asset('css/images/notice.png')}}">
                        </div>
                        <div class="card-content">
                            <span class = "card-title blue-text">Announcements</span>
                            <p>Post a message on the staff notice board</p>
                        </div>
                        <div class="card-action">
                            <a href="{{route('announcement.create')}}">View notice board</a>

                            <a href="{{route('announcement.create')}}">Add notice</a>
                        </div>
                    </div>
                </div>
                <div class="col s4">
                    <div class="card large">
                    <div class="card-image">
                            <img src="{{URL::asset('css/images/memo.jpg')}}">
                        </div>
                        <div class="card-content">
                            <span class = "card-title blue-text">Memo</span>
                            <p>Send a memo to a member of staff or an office </p>
                        </div>
                        <div class="card-action">
                            <a href="{{route('memo.create')}}">Send memo</a>
                            <a href="{{route('memo.index')}}">View memos</a>
                        </div>
                    </div>
           </div>
                </div>
           
        </div>
@endif
@endsection
