@extends('layouts.admin-app')

@section('content')
	
	<div class="row">
		<div class="col-md-12">
			<h2>Order details</h2>
		</div>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
			        <h4>First name: {{ $order->first_name }}</h4>
			        <h4>Last name: {{ $order->last_name }}</h4>
			        <h4>E-mail: {{ $order->email }}</h4>
			        <h4>City: {{ $order->city }}</h4>
			        <h4>Post number: {{ $order->post_number }}</h4>
			        <h4>Street name: {{ $order->street_name }}</h4>
			        <h4>Street number: {{ $order->street_number }}</h4>
			        <h4>Order number: {{ $order->token }}</h4>
			        <h4>Order date: {{ $order->created_at }}</h4>
			        <h4>Type of payment: {{ $order->type_of_payment }}</h4>
				</div>
				<div class="panel-body">
					<h3>Products:</h3>
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Product name</th>
									<th>Size</th>
									<th>Catalog number</th>
									<th>Product price</th>
									<th>Quantity</th>
									<th>Total price</th>
								</tr>
							</thead>
							<tbody>
								@foreach($order->order_items as $value)
								<tr>
									<td>{{ $value['item_name'] }}</td>
									<td>{{ $value['item_size'] }}</td>
									<td>{{ $value['item_catalog_number'] }}</td>
									<td>{{ $value['item_price'] }} €</td>
									<td>{{ $value['item_total_quantity'] }}</td>
									<td>{{ $value['item_total_price'] }} €</td>
								</tr>	
								@endforeach
							</tbody>
							<tfoot>
				        		<tr>
				        			<td colspan="3"><b>Total quantity: </b> {{ $order->total_quantity }}</td>
				        			<td colspan="3"><b>Total price: </b> <?php echo sprintf('%0.2f', $order->total_price) . " €"; ?> </td>
				        		</tr>
							</tfoot>
						</table>
					</div>	
				</div>
				<div class="panel-footer">
					@if($order->status == 0) 
						This order has been shipped
					@else
					<form action="{{ route('admin.order.shipped', ['id' => $order->id ]) }}" method="POST" class="form">
						{{ csrf_field() }}
						<div class="checkbox">
							<label for="status">
								<input name="status" value="0" type="checkbox"> Mark that the shipment has been shipped
							</label>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-md btn-info">Submit</button>
						</div>
					</form>
					@endif
				</div>
			</div>
		</div>
	</div>

@endsection