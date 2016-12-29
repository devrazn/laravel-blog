@extends('main')

<?php $pageTitle = htmlspecialchars($post->title) ?>
@section('title', ' - '.$pageTitle)

@section('content')

<?php 
  use Carbon\Carbon;
?>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			
				<img class="img-responsive" src="{{ asset('uploads/images/'.$post->image) }}" alt="Featured Image - {{ $post->image }}">
			
			<h1>{{ $post->title }}</h1>
			{!! $post->body !!}
			<hr>
			<p><b>Posted In:</b> {{ $post->category->name }}</p>
			<p>
				<b>Category Created At:</b> {{ $post->category->created_at }}
				<small>
					{{ Carbon::createFromFormat('Y-m-d H:i:s', $post->category->created_at)->diffForHumans() }}
				</small>
			</p>
			<hr>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h3 class="comments-title"><span class="glyphicon glyphicon-comment glyphicon-comment-title"> </span>Comments <span>({{ $post->comments()->count() }})</span></h3>
				@foreach($post->comments as $comment)
					<div class="comment">
						<div class="author-info">
							<img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) . "?s=50&d=mm" }}" class="author-image" alt="">
							<div class="author-name">
								<h4>{{ $comment->name }} <small> {{ $comment->email }} </small></h4>
								<p class="author-time">
									{{ date('nS M, Y g:iA', strtotime($comment->created_at)) }} 
									<small>
										{{ Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at)->diffForHumans() }}
									</small>
								</p>
							</div>
						</div>
						<div class="comment-content">
							<p>{{ nl2br($comment->comment) }}</p>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		<div class="row">
			<div id="comment-form" class="col-md-8 col-md-offset-2 comment-form">
				{!! Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) !!}
					<div class="row">
						<div class="col-md-6">
							{{ Form::label('name', "Name") }}
							{{ Form::text('name', null, ['class' => 'form-control']) }}
						</div>
						<div class="col-md-6">
							{{ Form::label('email', 'Email') }}
							{{ Form::text('email', null, ['class' => 'form-control']) }}
						</div>
						<div class="col-md-12">
							{{ Form::label('comment', 'Comment:') }}
							{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}
							{{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block btn-spacing-top']) }}
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>

@endsection