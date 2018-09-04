@extends('layouts.app')

@section('title')
	{{ $page->title }}
@endsection

@section('content')

	<div class="container page">
		<div class="row">
			<div class="col-md-12">
				<h2>{{ $page->title }}</h2>
			</div>
			<div class="col-md-12">
				{!! $page->content !!}
			</div>
		</div>
	</div>
	
@endsection