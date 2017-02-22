@extends('layouts.app')
@section('content')

	<div class="section">
	<div class="row">
		
	
		<div class="col m8 offset-m3">
			
		
		<div class="card">
			<div class="card-content">
				<form method="post" action="{{route('purchase.store')}}">
					{{ csrf_field()}}
					<div class="row">
						<div class="input-field col m12">
							<label for="delivery_site">Delivery Site</label>
							<input type="text" name="delivery_site" >
						</div>

					
					<div id="item_div">
					<span class = "center">Items</span>
					<table>
						<thead>
						<tr>
							<th>Quantity</th>
							<th>Unit</th>
							<th>Unit Price</th>
							<th>Description</th>
							</tr>
						</thead>
						<tbody id="item_div">
						
						</tbody>
					</table>
						
					</div>
					<div class="section">
						
					<div class="row">
						<div class="col m6 offset-m4">
						<a class = "btn btn-primary" id = "additem">Add item</a>
						<button class="btn btn-primary" type="submit">Submit</button>
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
