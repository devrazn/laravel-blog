@extends('main')

@section('title', ' - '.ucfirst($tag->name))

@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>{{ $tag->name }} - Tag <small>({{ $tag->posts()->count() }} Posts)</small></h1>
		</div>
		<div class="col-md-2">
			<a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary btn-block btn-head-edit">EDIT</a>
		</div>
		<div class="col-md-2">
			{{ Form::open(['route' => ['tags.destroy', $tag->id], "method" => "DELETE"]) }}
			{{ Form::submit("DELETE", ['class' => 'btn btn-danger btn-block btn-head-edit']) }}
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Title</th>
							<th>Tags</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($tag->posts as $post)
							<tr>
								<th>{{ $post->id }}</th>
								<td title="{{ $post->title }}" style="width:40%">
									{{ substr($post->title, 0, 59) }}
									@if(strlen($post->title) > 60)
										{{ "..." }}
									@endif
								</td>
								<td style="width:40%">
									@foreach($post->tags as $tag)
										<span class="label label-default">{{ $tag->name }}</span>
									@endforeach
								</td>
								<td>
									<a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-xs">View</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection