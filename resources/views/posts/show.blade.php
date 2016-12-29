@extends('main')

@section('title', ' - View Post')

@section('content')

<?php 
  use Carbon\Carbon;
?>
	<div class="row">
		<div class="col-md-8">
			<h1>{{ $post->title }}</h1>
			<img class="img-responsive" src="{{ asset('uploads/images/'.$post->image) }}" alt="Featured Image - {{ $post->image }}">
			<p class='lead'>{!! $post->body !!}</p>
			@if(count($post->tags) > 0)
				<hr>
				<div class="tags">
					@foreach($post->tags as $tag)
					<span class="label label-default">{{ $tag->name }}</span>
					@endforeach
				</div>
			@endif
			<div class="backend-comments">
				<h3>Comments <small>({{ $post->comments->count() }})</small></h3>
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Comment</th>
							<th width="100px">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($post->comments as $comment)
							<tr>
								<td title="{{ $comment->name }}">
									{{ substr($comment->name, 0, 39) }}
									@if(strlen($comment->name) > 40)
									 {{ "..." }}
									@endif
								</td>
								<td  title="{{ $comment->email }}">
									{{ substr($comment->email, 0, 39) }}
									@if(strlen($comment->email) > 40)
									 {{ "..." }}
									@endif
								</td>
								<td>
									{{ substr($comment->comment, 0, 49) }}
									@if(strlen($comment->comment) > 50)
									 {{ "..." }}
									@endif
								</td>
								<td>
									<a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"> </span></a>
									<a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"> </span></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<label>URL:</label>
					<p> <a href="{{ route('blog.single', $post->slug) }}">{{ url('blog/'.$post->slug) }}</a> </p>
				</dl>
				<dl class="dl-horizontal">
					<label>Created At:</label>
					<p>
						{{ date('M j, Y g:iA', strtotime($post->created_at)) }} 
						<br>
						<small>
							<?php echo Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->diffForHumans();?>
						</small>
					</p>
				</dl>
				<dl class="dl-horizontal">
					<label>Last Updated:</label>
					<p>
						{{ date('M j, Y g:iA', strtotime($post->updated_at)) }} 
						<br>
						<small>
							<?php echo Carbon::createFromFormat('Y-m-d H:i:s', $post->updated_at)->diffForHumans();?>
						</small>
					</p>
				</dl>
				<dl class="dl-horizontal">
					<label>Category:</label>
					<p>
						{{ $post->category->name }}
					</p>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block btn-pair-top')) !!}
					</div>
					<div class="col-sm-6">
						{!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => "Delete"]) !!}
						{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block btn-pair-top']) !!}
						{!! Form::close() !!}
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						{!! Html::linkRoute('posts.index', '<< View All Posts', array(), array('class' => 'btn btn-default btn-block btn-pair-top')) !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection