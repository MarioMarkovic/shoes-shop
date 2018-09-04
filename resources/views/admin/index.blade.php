@extends('layouts.admin-app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Welcome to admin dashboard</h1><br>
    </div>
    <div class="col-sm-12 col-md-9">
    	@if(isset($orders) && count($orders) > 0)
    		<h2><a href="{{ route('admin.order.index') }}">New orders: <span class="badge" style="font-size: 16px;background-color: #3097D1;">{{ count($orders) }}</span></a></h2><br>
    	<div class="table-responsive">
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
    	@else 
    	<div class="col-md-12 alert alert-info">
    		<h4>No orders to show</h4>
		</div>
    	@endif
    </div>
    <div class="col-sm-12 col-md-3 clearfix">
    	<br>
    	<a href="{{ route('admin.product.create') }}" class="btn btn-lg btn-primary pull-right">Add new product</a>
    </div>
</div>
@endsection

