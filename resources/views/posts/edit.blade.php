@extends('main')

@section('title', ' - Edit Blog Post')

@section('stylesheets')
		{{ Html::style('parsley/parsley.css') }}
		{{ Html::style('select2/select2.min.css') }}<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	    <script>
	        tinymce.init({
	            selector: 'textarea',
	            plugins: "link code fullscreen image",
	        });
	    </script>
@endsection

@section('content')
<?php 
  use Carbon\Carbon;
?>
	<div class="row">
	{!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'data-parsley-validate' => '', 'files' => true]) !!}
		<div class="col-md-8">
			{{ Form::label('title', 'Title:') }}
			{{ Form::text('title', null, ["class" => "form-control input-lg", 'placeholder' => 'Please enter title for the post', 'required' => '', 'maxlength' => '255']) }}

			{{ Form::label('slug', 'Slug:', ["class" => "form-spacing-top"]) }}
			{{ Form::text('slug', null, array('class' => 'form-control', 'placeholder' => "Please enter a unique phrase(words separated by dash) to identify this post.", 'required' => '', 'min-length' => '5', 'max-length' => '255')) }}

			{{ Form::label('category_id', 'Category:', ["class" => "form-spacing-top"]) }}
    		{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
    		
    		{{ Form::label('tags', 'Tags:', ["class" => "form-spacing-top"]) }}
    		{{ Form::select('tags[]', $tags, null, ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'tags', "data-placeholder" => "Select tags"]) }}

    		{{ Form::label('featured_image', 'Update Featured Image', ['class' => 'form-spacing-top']) }}
    		<div class='controls'>
    			<img class="img-responsive" width="auto" height="360" src="{{ asset('uploads/images/'.$post->image) }}" alt="Featured Image - {{ $post->image }}">
    		</div>
    		{{ Form::file('featured_image') }}

			{{ Form::label('body', 'Body:', ["class" => "form-spacing-top"]) }}
			{{ Form::textarea('body', null, ["class" => "form-control", 'placeholder' => 'Please enter the contents for the post', 'required' => '']) }}
		</div>
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Created At:</dt>
					<dd>
						{{ date('M j, Y g:iA', strtotime($post->created_at)) }} 
						<br>
						<small>
							<?php echo Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->diffForHumans();?>
						</small>
					</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Last Updated:</dt>
					<dd>
						{{ date('M j, Y g:iA', strtotime($post->updated_at)) }} 
						<br>
						<small>
							<?php echo Carbon::createFromFormat('Y-m-d H:i:s', $post->updated_at)->diffForHumans();?>
						</small>
					</dd>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-4">
						{{ Form::reset("Reset", array('class' => 'btn btn-warning btn-block btn-pair', 'id' => 'reset')) }}
					</div>
					<div class="col-sm-4">
						{!! Html::linkRoute('posts.index', 'Cancle', array(), array('class' => 'btn btn-danger btn-block btn-pair')) !!}
					</div>
					<div class="col-sm-4">
						{{ Form::submit("Save", array('class' => 'btn btn-success btn-block')) }}
					</div>
				</div>
			</div>
		</div>
		{!! Form::close() !!}<!-- Close form here -->
	</div>
@endsection

@section('scripts')
	{!! Html::script('parsley/parsley.min.js') !!}
	{!! Html::script('select2/select2.min.js') !!}
	<script type="text/javascript">
        $("#tags").select2();
        $("#tags").select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
        $("#reset").click(function(){
        	// $("#tags").select2('val', 'All');
			$('#tags').select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
    	});
    </script>
@endsection