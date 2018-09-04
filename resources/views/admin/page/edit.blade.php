@extends('layouts.admin-app')
@section('js')			
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
	<script src="{{ asset('js/text-editor.js') }}"></script>
@endsection	
@section('content')

	<div class="row" style="margin-bottom: 100px;">
		<div class="col-md-12">
			<h2>Update page</h2><br><br>
		</div>
		<div class="col-md-12">
			{!! Form::open(['route' => ['admin.page.update', $page->id], 'method' => 'POST' ]) !!}
			
			<div class="form-group">
				<?php echo Form::label('title', 'Page title:'); ?>
				<?php echo Form::text('title', "$page->title", [ 'class' => 'form-control', 'id' => 'title', 'required' => 'required', 'maxlength' => '191' ]); ?>
				@if($errors->has('title')) 
					@foreach($errors->get('title') as $error)
						<small class="help-text text-danger">{{ $error }}</small>
					@endforeach
				@endif	
			</div>
			<div class="form-group">
				<?php echo Form::label('content', 'Page content:'); ?>
				<?php echo Form::textarea('content', "$page->content", [ 'class' => 'form-control', 'id' => 'content', 'required' => 'required' ]); ?>
				@if($errors->has('content')) 
					@foreach($errors->get('content') as $error)
						<small class="help-text text-danger">{{ $error }}</small>
					@endforeach
				@endif	
			</div>
			<br>		
			<button type="submit" class="btn btn-lg btn-primary">Save</button>	
			{!! Form::close() !!}	
		</div>
	</div>
@endsection