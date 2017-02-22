@extends('layouts.app')

@section('content')
<div class="section">
            <div class="row">
                <div class="col s4 offset-s3" style="margin-top: 50px;">
                    <div class="card medium">
                    <div class="card-image">
                            <img src="{{URL::asset('css/images/facility.png')}}">
                        </div>
                        <div class="card-content">
                            <span class = "card-title blue-text">Use of university facility</span>
                            <p></p>
                        </div>
                        @if(Auth::user()->department_id !=4)
                        <div class="card-action">
                            <a href="{{route('facilities')}}">View report</a>
                            <a href="{{route('facilityaction')}}">Action</a>
                            <a href="{{route('statistics')}}">View statistics</a>
                        </div>
                        @else
                        <div class="card-action">
                            <a href="{{route('facilities')}}">View report</a>
                            <a href="{{route('facilityaction')}}">Action</a>
                            <a href="{{route('statistics')}}">View statistics</a>
                        </div>
                        @endif

                    </div>
                </div>
                <div class="col s4">
                    <div class="card medium">
                    <div class="card-image">
                            <img src="{{URL::asset('css/images/transport.png')}}">
                        </div>
                        <div class="card-content">
                            <span class = "card-title blue-text">Transport applications</span>
                            <p></p>
                        </div>
                        <div class="card-action">
                            <a href="{{route('transportpdf')}}">View report</a>
                            <a href="{{route('transport.index')}}">Action</a>
                            <a href="{{route('transportstats')}}">View statistics</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s4 offset-s3">
                    <div class="card  medium">
                    <div class="card-image">
                            <img src="{{URL::asset('css/images/purchase.png')}}">
                        </div>
                        <div class="card-content">
                            <span class = "card-title blue-text">Purchase requests</span>
                            <p></p>
                        </div>
                        <div class="card-action">
                            <a href="{{route('purchasepdf')}}">View report</a>
                            <a href="{{route('purchase.index')}}">Action</a>
                            <a href="{{route('purchasestats')}}">View statistics</a>
                        </div>
                    </div>
                </div>
                <div class="col s4">
                    <div class="card medium">
                    <div class="card-image">
                            <img src="{{URL::asset('css/images/leave.png')}}">
                        </div>
                        <div class="card-content">
                            <span class = "card-title blue-text">Absence management</span>
                            <p></p>
                        </div>
                        <div class="card-action">
                            <a href="#">View report</a>
                            <a href="{{route('leave.index')}}">Action</a>
                            <a href="#">View statistics</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s4 offset-s3">
                    <div class="card medium">
                    <div class="card-image">
                            <img src="{{URL::asset('css/images/repair.png')}}">
                        </div>
                        <div class="card-content">
                            <span class = "card-title blue-text">Facility Maintenance</span>
                            <p></p>
                        </div>
                        <div class="card-action">
                            <a href="{{route('maintenancepdf')}}">View report</a>
                            <a href="{{route('maintenance.index')}}">Action</a>
                            <a href="{{route('maintenancestats')}}">View statistics</a>
                        </div>
                    </div>
                </div>
                <div class="col s4">
                    <div class="card medium">
                    <div class="card-image">
                            <img src="{{URL::asset('css/images/food.png')}}">
                        </div>
                        <div class="card-content">
                            <span class = "card-title blue-text">Food application</span>
                        </div>
                        <div class="card-action">
                        	<a href="{{route('feed')}}">View report</a>
                            <a href="{{route('food.index')}}">Action</a>
                            <a href="{{route('foodstats')}}">View statistics</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection