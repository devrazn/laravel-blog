@extends('main')

@section('title', ' - Create New Post')

@section('stylesheets')
    {{ Html::style('parsley/parsley.css') }}
    {{ Html::style('select2/select2.min.css') }}
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: "link code fullscreen image",
            /*toolbar: "undo redo | cut copy paste"
            menu: {
                view: {title: "Edit", items: "cut, copy, paste"}
            }*/

        });
    </script>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Create New Post</h1>
			<hr>
			{{ Form::open(array('route' => 'posts.store', 'data-parsley-validate' => '', 'files' => true )) }}
    			{{ Form::label('title', "Title:") }}
    			{{ Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Please enter title for the post', 'maxlength' => '255', "required" => "")) }}

    			{{ Form::label('slug', 'Slug:', ["class" => "form-spacing-top"]) }}
    			{{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'min-length' => '5', 'max-length' => '255')) }}

    			{{ Form::label('category_id', 'Category:', ["class" => "form-spacing-top"]) }}
                {{ Form::select('category_id', $categories, null, ['class' => 'form-control', "required" => ""]) }}
    			

                {{ Form::label('tags', 'Tags:', ["class" => "form-spacing-top"]) }}
                <select name="tags[]" id="tags" class="form-control" multiple="multiple" data-placeholder="Select tags">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
                {{ Form::label('featured_image', 'Upload Featured Image', ['class' => 'form-spacing-top']) }}
                {{ Form::file('featured_image') }}
    			{{ Form::label('body', "Post Body:", ["class" => "form-spacing-top"]) }}
    			{{ Form::textarea('body', null, array('class' => 'form-control', 'placeholder' => 'Please enter the contents for the post')) }}
    			{{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top:20px')) }}
			{{ Form::close() }}
		</div>
	</div>
@endsection


@section('scripts')
	{!! Html::script('parsley/parsley.min.js') !!}
    {!! Html::script('select2/select2.min.js') !!}
    <script type="text/javascript">
        $("#tags").select2();
    </script>
@endsection