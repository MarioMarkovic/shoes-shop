@extends('layouts.admin-app')

@section('content')
	<div class="row" style="margin-bottom: 100px">
		<div class="col-md-12">
			<h2>{{ $product->name }}</h2><br>
		</div>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3><b>Catalog number:</b> {{ $product->catalog_number }}</h3>
				</div>
				<div class="panel-body">
					<img style="width: 50%" src="/storage/images/{{ $product->image }}" class="img-thumbnail">
					<br><br>
					<p class="lead"><b>Description:</b> <br>{{ $product->description }}</p>
					<h4><b>Price:</b> {{$product->price}}</h4>
					<h4><b>Discount:</b> @if(isset($product->discount)){{$product->discount}} @else No discount @endif</h4>
					<h4><b>Category:</b> <?php echo ucfirst(strtolower($product->category->name)); ?></h4><br>
					<hr>
					<h3>Sizes:</h3>
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th class="col-sm-6 col-md-6">Size</th>
									<th class="col-sm-6 col-md-6">Quantity</th>
								</tr>
							</thead>
							<tbody>
								@foreach($product->quantity_size as $qty)
								<tr>
									<td>{{$qty->size }}</td>
									<td>{{$qty->quantity}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection