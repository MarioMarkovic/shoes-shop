@extends('layouts.admin-app')

@section('content')
	<div class="row" style="margin-bottom: 100px;">
		<div class="col-md-12">
			<h2>Manage pages</h2><br>		
		</div>
		<div class="col-md-12">
			<a href="{{ route('admin.page.create') }}" class="btn btn-lg btn-primary">Create new page</a><br><br>
		</div>
		@if(count($pages) > 0)
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="col-md-3">Page id</th>
							<th class="col-md-3">Page title</th>
							<th class="col-md-3"></th>
							<th class="col-md-3"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($pages as $page)
							<tr>
								<td>{{ $page->id }}</td>
								<td>
									<a href="{{ route('admin.page.show', [ 'id' => $page->id]) }}">
										<?php echo ucfirst(strtolower($page->title)); ?>
									</a>
								</td>
								<td>
									<a href="{{ route('admin.page.edit', ['id' => $page->id ]) }}" class="btn btn-lg btn-primary">Edit</a>
								</td>
								<td>
									{!! Form::open(['route' => ['admin.page.destroy', $page->id ], 'method' => 'DELETE', 'onsubmit' => 'return confirm("Are you sure that you want to delete this page?")' ]) !!}
									<?php echo Form::submit('Delete', ['class' => 'btn btn-lg btn-danger ']); ?>
								{!! Form::close() !!}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>	
			</div>
		</div>				
		@else 			
		<div class="col-md-12 alert alert-info">
				<h4>No pages to show</h4>
			</div>
		@endif
	</div>	

@endsection