@extends('layouts.app')

@section('title')
	SEARCH
@endsection

@section('content')
	<div class="row">
		@if(count($products) == 0)
			<div class="col-md-12 text-center category-name">
				<h3>No results for: {{ $item }}</h3>
			</div>
		@else 
			<div class="col-md-12 text-center category-name">
				<h3>Results for: {{ $item }}</h3>
			</div>
			@foreach($products as $product)
			<div class="fade col-sm-12 col-md-6 col-lg-6">
				<a href="{{ route('public.product.fullView', ['id' => $product->id ]) }}">
					<div class="show-sizes-and-name">
						<h3>{{ $product->name }}</h3>
						<div class="sizes">
							@foreach($product->quantity_size as $qty)
								@if($qty->quantity == 0 )
								@else 
									<span>{{ $qty->size }}</span>
								@endif	
							@endforeach
						</div>	
						<p class="price">
							Price: € {{ $product->price }}
							@if(isset($product->discount)) 
								Discount: {{ $product->discount }}% 
							@endif
						</p>
					</div>
					<div>
						<img src="/storage/images/{{ $product->image }}">
					</div>
				</a>	
			</div>
			@endforeach
		</div>
		<div class="text-center col-sm-12 col-md-12 col-lg-12">
			{{ $products->appends(Request::only('search'))->links() }}
		</div>	
	@endif	

@endsection