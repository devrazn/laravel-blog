@extends('main')

@section('title', ' - All Posts')

@section('content')

<?php 
  use Carbon\Carbon;
?>
	<div class="row">
		<div class="col-md-10">
			<h1>All Posts</h1>
		</div>
		<div class="col-md-2">
			<a href="{{ route('posts.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create New Post</a>
		</div>
		<div class="col-md-12">
			<hr>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<th>#</th>
					<th>Title</th>
					<th>Body</th>
					<th>Created At</th>
					<th>Updated At</th>
					<th>Actions</th>
				</thead>
				<tbody>
					@foreach ($posts->all() as $post)
					<tr>
						<th>{{ $post->id }}</th>
						<td title="{{ $post->title }}">{{ substr($post->title, 0, 20)}}{{ strlen($post->title) > 50 ? "..." : "" }}</td>
						<td>
							{{ substr(strip_tags($post->body), 0, 44)}}{{ strlen(strip_tags($post->body)) > 45 ? "..." : "" }}
						</td>
						<td>
							{{ $post->created_at}} 
							<small>
								<?php echo Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->diffForHumans();?>
							</small>
						</td>
						<td>
							{{ $post->updated_at}} 
							<small>
								<?php echo Carbon::createFromFormat('Y-m-d H:i:s', $post->updated_at)->diffForHumans();?>
							</small>
						</td>
						<td>
							<a class="btn btn-success btn-sm btn-btn-right" href="{{ route('posts.show', $post->id) }}">VIEW</a>
							<a class="btn btn-sm btn-warning" href="{{ route('posts.edit', $post->id) }}">EDIT</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $posts->links() !!}
			</div>
		</div>
	</div>
@endsection