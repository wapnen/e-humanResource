@extends('layouts.app')
@section('content')
	<div class="section">
            <div class="row">
                <div class="col s4 offset-s3" style="margin-top: 50px;">
                    <div class="card">
                        <div class="card-content">
                            <span class = "card-title blue-text">Hospital Charges</span>
                            <p></p>
                        </div>
                      
                        <div class="card-action">
                            <a href="{{route('healthpdf')}}">View report</a>
                            <a href="{{route('healthcharge.index')}}">Action</a>
                            <a href="{{route('healthstatistics')}}">View statistics</a>
                        </div>
                       

                    </div>
                </div>
                <div class="col s4">
                    <div class="card">
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
                    <div class="card">
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
                    <div class="card">
                        <div class="card-content">
                            <span class = "card-title blue-text">Absence management</span>
                            <p></p>
                        </div>
                        <div class="card-action">
                            <a href="{{route('leavepdf')}}">View report</a>
                            <a href="{{route('leave.index')}}">Action</a>
                            <a href="{{route('leavestats')}}">View statistics</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s4 offset-s3">
                    <div class="card">
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
                    <div class="card">
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