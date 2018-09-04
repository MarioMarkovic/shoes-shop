@extends('layouts.app')

@section('title')
	{{ $product->name }}
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8 col-lg-8 product-image">
			<img src="/storage/images/{{ $product->image }}">
		</div>
		<div class="col-md-4 col-lg-4 product-description">
			<h3>{{ $product->name }}</h3>
			<div>
				<h4>Price: € {{ $product->price }}</h4>
			</div>
			<p>
				{{ $product->description }}
			</p>
			<div>
				<form action="{{ route('public.addToCart', ['id' => $product->id ]) }}" method="GET">
					<label for="size_id">Select your size:</label>
					<select id="size_id" name="size_id">
						@foreach($product->quantity_size as $qty)
							@if($qty->quantity > 0)
								<option value="{{ $qty->id }}">{{ $qty->size }}</option>
							@else 
							@endif
						@endforeach
					</select>
					<button type="submit">Add to cart</button>
				</form>
			</div>
		</div>
	</div>
@endsection