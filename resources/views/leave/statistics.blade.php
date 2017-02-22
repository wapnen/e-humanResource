@extends('layouts.app')
@section('content')

{!! Charts::assets() !!}
	<div class="section">
		<div class="row">
			<div class="col s8 offset-s3">
				 <center>
            {!! $chart->render() !!}
            <a class = "btn" href="{{route('transport.index')}}">Back</a>
        </center>
			</div>
		</div>
       
	</div>
@endsection