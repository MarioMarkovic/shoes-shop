@extends('layouts.admin-app')

@section('content')
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<h2>Orders</h2><br>
		</div>
		<div class="col-sm-12 col-md-12 search-buttons">
			<div class="col-xs-12 col-sm-6 col-md-3">
				<a href="/admin/all-orders/paypal" class="btn btn-info btn-md">Paid with PayPal</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<a href="/admin/all-orders/delivery" class="btn btn-info btn-md">Pay on Delivery</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">	
				<a href="/admin/all-orders/1" class="btn btn-info btn-md">Active orders</a>
			</div>	
			<div class="col-xs-12 col-sm-6 col-md-3">
				<a href="/admin/all-orders/0" class="btn btn-info btn-md">Inactive orders</a>
			</div>
		</div>
		<div class="col-sm-12 col-md-12">
    	@if(isset($orders) && count($orders) > 0)
    	<div class="table-responsive">
    		<br>
    		<table class="table table-striped table-bordered">
    			<thead>
    				<tr>
    					<th class="col-md-2">Order id</th>
    					<th class="col-md-3">First and last name</th>
    					<th class="col-md-3">Email</th>
    					<th class="col-md-2">Type of payment</th>
    					<th class="col-md-2">Created at</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($orders as $order)
						<tr>
							<td>{{ $order->id }}</td>
							<td>
								<a href="{{ route('admin.order.show', [ 'id' => $order->id ]) }}">
									{{ $order->first_name }} {{ $order->last_name }}
								</a>
							</td>
							<td>{{ $order->email }}</td>
							<td>{{ $order->type_of_payment }}</td>
							<td>{{ $order->created_at }}</td>
						</tr>
    				@endforeach
    			</tbody>
    		</table>
    	</div>
    	<div class="text-center col-sm-12 col-md-12 col-lg-12">
			@if($orders instanceof \Illuminate\Pagination\LengthAwarePaginator)
				{{ $orders->links() }}
			@endif
		</div>	
    	@else
    	<div class="col-md-12 alert alert-info">
    		<h4>No orders to show</h4>
		</div>	
    	@endif
    </div>
	</div>

@endsection