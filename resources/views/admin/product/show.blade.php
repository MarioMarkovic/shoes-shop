@extends('layouts.admin-app')

@section('content')
	
	<div class="row" style="margin-bottom: 100px">
		<div class="col-md-12">
			@if(isset($name))<h2>{{ $name }}</h2><br>@endif
		</div>
		<div class="col-md-12">
			<form action="" method="GET" class="form">
				<div class="form-group">
					<label for="search">Search products:</label>
					<input type="number" id="search" placeholder="Search by catalog number" name="search" required class="form-control">
					@if($errors->has('search'))
						@foreach($errors->get('search') as $error)
							<small class="help-text text-danger">{{ $error }}</small>
						@endforeach
					@endif
				</div>
				<button type="submit" class="btn btn-md btn-primary">Search</button>
			</form>
			<br>
		</div>
		@if(count($products) > 0)
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="col-md-2">Catalog number</th>
							<th class="col-md-3">Name</th>
							<th class="col-md-3">Image</th>
							<th class="col-md-2">Netto Price</th>
							<th class="col-md-1"></th>
							<th class="col-md-1"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($products as $product)
						<tr>
							<td>{{ $product->catalog_number }}</td>
							<td>
								<!-- route for product full view -->
								<a href="{{ route('admin.product.fullView', ['id' => $product->id ]) }}">{{ $product->name }}</a>
							</td>
							<td>
								<img class="img-thumbnail" style="width: 100%" src="/storage/images/{{ $product->image }}">
							</td>
							<td>{{ $product->price }}</td>

							<!-- routes for edit and delete -->
							<td><a href="{{ route('admin.product.edit', ['id' => $product->id ]) }}" class="btn btn-primary btn-lg">Edit</a></td>
							<td>
								{!! Form::open(['route' => ['admin.product.destroy', $product->id ], 'method' => 'DELETE', 'onsubmit' => 'return confirm("Are you sure that you want to delete this item?")' ]) !!}
									<?php echo Form::submit('Delete', ['class' => 'btn btn-lg btn-danger ']); ?>
								{!! Form::close() !!}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="text-center col-sm-12 col-md-12 col-lg-12">
			@if($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
				{{ $products->links() }}
			@endif
		</div>	
		@else 
			<div class="col-md-12 alert alert-info">
				<h4>No products to show</h4>
			</div>
		@endif
	</div>

@endsection