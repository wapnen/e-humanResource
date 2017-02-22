@extends('layouts.app')

@section('content')
<div class="section">
            <div class="row">
                <div class="col s4 offset-s3" style="margin-top: 50px;">
                    <div class="card">
                        <div class="card-content">
                            <span class = "card-title blue-text">View report on transport requests</span>
                            <p></p>
                        </div>
                     
                        <div class="card-action">
                           <a href="{{route('transportpdf')}}">View </a>
                            
                        </div>
                       

                    </div>
                </div>
                <div class="col s4">
                    <div class="card">
                        <div class="card-content">
                            <span class = "card-title blue-text">View statistics of transport requests</span>
                            <p></p>
                        </div>
                        <div class="card-action">
                            
                            
                            <a href="{{route('transportstats')}}">View </a>
                        </div>
                    </div>
                </div>
            </div>
           <div class="row">
               <div class="col s4 offset-s5">
                    <div class="card">
                        <div class="card-content">
                            <span class = "card-title blue-text">Review, Approve or decline requests</span>
                            <p></p>
                        </div>
                        <div class="card-action">
                            
                            <a href="{{route('transport.index')}}">Action</a>
                            
                        </div>
                    </div>
               </div>
           </div>
           
        </div>

@endsection