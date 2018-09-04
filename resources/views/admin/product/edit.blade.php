@extends('layouts.admin-app')

@section('content')
	
	<div class="row" style="margin-bottom: 100px;">
		<div class="col-md-12">
			<h2>Update product</h2><br><br>
		</div>
		<div class="col-md-12">
			{!! Form::open(['route' => ['admin.product.update', $product->id], 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}
			
			<div class="form-group">
				<?php echo Form::label('name', 'Product name:'); ?>
				<?php echo Form::text('name', "$product->name", [ 'class' => 'form-control', 'id' => 'name', 'required' => 'required', 'maxlength' => '191' ]); ?>
				@if($errors->has('name')) 
					@foreach($errors->get('name') as $error)
						<small class="help-text text-danger">{{ $error }}</small>
					@endforeach
				@endif	
			</div>
			<div style="margin: 25px 0px">
				<img src="/storage/images/{{ $product->image }}" class="img-thumbnail">
			</div>	
			<div class="form-group">
				<?php echo Form::label('image', 'Product image:'); ?>
				<?php echo Form::file('image', [ 'class' => 'form-control', 'id' => 'image' ]); ?>
				@if($errors->has('image')) 
					@foreach($errors->get('image') as $error)
						<small class="help-text text-danger">{{ $error }}</small>
					@endforeach
				@endif	
			</div>	
			<div class="form-group">
				<?php echo Form::label('description', 'Product description:'); ?>
				<?php echo Form::textarea('description', "$product->description", [ 'class' => 'form-control', 'id' => 'description', 'required' => 'required' ]); ?>
				@if($errors->has('description')) 
					@foreach($errors->get('description') as $error)
						<small class="help-text text-danger">{{ $error }}</small>
					@endforeach
				@endif	
			</div>	
			<div class="form-group">
				<?php echo Form::label('price', 'Product price:'); ?>
				<?php echo Form::number('price', "$product->price", [ 'class' => 'form-control', 'id' => 'price', 'step' => 'any', 'min' => '1', 'placeholder' => 'Enter netto price', 'required' => 'required' ]); ?>
				@if($errors->has('price')) 
					@foreach($errors->get('price') as $error)
						<small class="help-text text-danger">{{ $error }}</small>
					@endforeach
				@endif	
			</div>
			<div class="form-group">
				<?php echo Form::label('discount', 'Discount:'); ?>
				<?php echo Form::number('discount', "$product->discount", [ 'class' => 'form-control', 'id' => 'discount', 'min' => '1' ]); ?>
				@if($errors->has('discount')) 
					@foreach($errors->get('discount') as $error)
						<small class="help-text text-danger">{{ $error }}</small>
					@endforeach
				@endif	
			</div>	
			<div class="form-group">
				<?php echo Form::label('catalog_number', 'Catalog number:'); ?>
				<?php echo Form::number('catalog_number', "$product->catalog_number", [ 'class' => 'form-control', 'id' => 'catalog_number', 'required' => 'required', 'min' => '100' ]); ?>
				@if($errors->has('catalog_number')) 
					@foreach($errors->get('catalog_number') as $error)
						<small class="help-text text-danger">{{ $error }}</small>
					@endforeach
				@endif	
			</div>	
			<div class="form-group">
				<?php echo Form::label('category_id', 'Category:'); ?>
				<select name="category_id" id="category_id" class="form-control" required="required">
					<option value="null">--</option>
					@foreach($categories as $category)
						<option value="{{ $category->id }}" @if($category->id == $product->category_id) selected @endif>{{ $category->name }}</option>
					@endforeach
				</select>
				@if($errors->has('category_id')) 
					@foreach($errors->get('category_id') as $error)
						<small class="help-text text-danger">{{ $error }}</small>
					@endforeach
				@endif	
			</div>
			<br><hr>	
			<h3>Sizes</h3>
			<hr>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
					    	<th class="col-xs-5 col-sm-5 col-md-5">Size</th>
					    	<th class="col-xs-5 col-sm-5 col-md-5">Quantity</th>
					    	<th class="col-xs-2 col-sm-2 col-md-2"></th>
					    </tr>
					</thead>
					<tbody id="TextBoxContainer">
						@foreach($product->quantity_size as $key => $qty)
						<tr>
							<td>
								<input name="size[]" value="{{ $qty->size }}" type="number" class="form-control" required min="10" max="55" />
							</td>
							<td>
								<input name="quantity[]" value="{{ $qty->quantity }}" type="number" class="form-control" required min="0"/>
							</td>
							<td>
								@if($key == 0)
									Product needs to <br> have at least one size!
								@else
									<button type="button" class="btn btn-danger remove">Remove</button>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
					  <tr>
					    <th colspan="3">
					    <button id="btnAdd" type="button" class="btn btn-primary" data-toggle="tooltip" data-original-title="Add more controls"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Add size&nbsp;</button></th>
					  </tr>
					</tfoot>
				</table>
			</div>	
			<br>		
			<button type="submit" class="btn btn-lg btn-primary">Save</button>	
			{!! Form::close() !!}
		</div>
	</div>

@endsection