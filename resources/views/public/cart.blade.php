@extends('layouts.app')

@section('title')
	CART
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">	
		@if(Session::has('cart'))
		<div class="table-responsive cart">
			<h2>Cart:</h2>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Product Name</th>
						<th class="col-xs-1 col-sm-1 col-md-1 col-lg-1">Size</th>
						<th class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Catalog Number</th>
						<th class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Price for one Product</th>
						<th class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Quantity</th>
						<th class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Final Price</th>
						<th class="col-xs-1 col-sm-1 col-md-1 col-lg-1" colspan="2"></th>
					</tr>
				</thead>
				@foreach($products as $key => $product)
					<tbody>
						<tr>
							<td>{{ $product['item']['name'] }}</td>
							<td>
								@foreach($product['item']['quantity_size'] as $value)
								 {{ $value->size }}
								@endforeach
							</td>
							<td>{{ $product['item']['catalog_number'] }}</td>
							<td>{{ $product['item']['price'] }} €</td>
							<td class="add-quantity-form">
								<form action="{{ route('public.cart.addProductQuantity', [ 'id' => $key ]) }}" method="POST">
									{{ csrf_field() }}
									<input type="number" name="quantity" value="{{ $product['quantity'] }}">
									<button><i class="fa fa-lg fa-retweet"></i></button>
								</form>
							</td>
							<td>{{ $product['price'] }} €</td>
							<td colspan="2" class="text-center">
								<a href="{{ route('public.cart.deleteItem', ['id' => $key]) }}">
									<i class="fa fa-lg fa-times"></i>
								</a>
							</td>
						</tr>
					</tbody>
				@endforeach
				<tfoot>
					<tr>
						<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" colspan="4">Total Price: {{ $totalPrice }} €</td>
						<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" colspan="4">
							<a href="{{ route('public.cart.delete') }}" class="empty-cart">Empty Cart</a>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	<div class="text-center payment-buttons col-xs-12 col-sm-12 col-md-12">
			<a class="col-xs-12 col-sm-12 col-md-6" href="{{ route('public.paymentOnDelivery') }}">Payment on delivery</a>
			<a class="col-xs-12 col-sm-12 col-md-6" href="{{ route('public.payWithPaypal') }}">Payment wih PayPal</a>
		</div>
	@else 
		<h2 class="text-center">No Items In Your Cart</h2>
	@endif
</div>
@endsection