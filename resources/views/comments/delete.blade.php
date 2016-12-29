@extends('main')

@section('title', ' - Delete Comment')

@section('content')

	<div class="row">
		<div class="col-md-offset-2 col-md-8">
			<h1>DELETE THIS COMMENT?</h1>
			<p>
				<strong>Name:</strong> {{ $comment->name }}
				<strong>Email:</strong> {{ $comment->email }}
			</p>
			<h3>Comment</h3>
			<p>{{ $comment->comment }}</p>
			{!! Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) !!}
			{{ Form::submit('Yes, Delete this Comment', ['class' => 'btn btn-danger btn-lg btn-block btn-margin-top']) }}
			{!! Form::close() !!}
		</div>
	</div>

@endsection