@extends('layouts.admin-app')

@section('content')
	<div class="row" style="margin-bottom: 100px">
		<div class="col-md-12">
			<h2>Title: {{ $page->title }}</h2><br>
		</div>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3><b>Page id:</b> {{ $page->id }}</h3>
				</div>
				<div class="panel-body">
					<h4><b>Content:</b></h4>
					<p class="lead">
						{!! $page->content !!}
					</p>
				</div>
			</div>
		</div>
	</div>
@endsection					