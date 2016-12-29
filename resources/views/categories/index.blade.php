@extends('main')

@section('title', ' - All Categories')

@section('stylesheets')
	{{ Html::style('parsley/parsley.css') }}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>Categories</h1>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
					</tr>
				</thead>
				<tbody>
					@foreach($categories as $category)
					<tr>
						<th>{{ $category->id }}</th>
						<td>{{ $category->name }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div> <!-- end of col-md-8 -->
		<div class="col-md-3">
			<div class="well">
				{!! Form::open(['route' => 'categories.store', 'data-parsley-validate' => '']) !!}
				<h2>New Category</h2>
				{{ Form::label('name', 'Name') }}
				{{ Form::text('name', null, ['class' => 'form-control', 'required' => '']) }}
				{{ Form::submit('Create New Category', ['class' => 'btn btn-success btn-block btn-spacing-top']) }}
				{!! Form::close() !!}
			</div>
		</div>
	</div>

@endsection

@section('scripts')
	{!! Html::script('parsley/parsley.min.js') !!}
@endsection