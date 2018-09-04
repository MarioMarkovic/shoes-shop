<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<body> 
	<div class="container">
		<h2>Your order has been confirmed!</h2>
		<p>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos debitis laudantium dolorum libero optio laboriosam architecto dicta possimus ex sit repudiandae, repellat deleniti, quod earum amet natus fugit quis, modi.
		</p>
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
			</div>
			<div class="panel-body">
				<h3>Products:</h3>
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
						@foreach($order_items as $value)
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
			<div class="panel-footer">
				<h3>ShoeShop</h3>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique veritatis explicabo repellendus vel, cumque commodi natus veniam dignissimos debitis voluptas tempora modi suscipit delectus, perspiciatis enim repellat exercitationem fuga dolorem.
				</p>
				<h4>Contact information:</h4>
				<ul>
					<li>Lorem ipsum: 000000000</li>
					<li>Dolor: example@gmail.com</li>
					<li>Sit amet: Mario Markovic</li>
					<li>repellat fuga dolorem: 34344233244</li>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>