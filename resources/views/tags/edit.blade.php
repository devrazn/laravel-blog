@extends('main')

@section('title', ' - Edit Tag')

@section('content')
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			{!! Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => 'PUT', 'data-parsley-validate' => '']) !!}
			{{ Form::label('name', 'Name') }}
			{{ Form::text('name', null, ["class" => "form-control", 'placeholder' => 'Please enter tag name', 'required' => '', 'maxlength' => '255']) }}
			{{ Form::submit('Save', ['class' => "btn btn-success btn-block form-spacing-top"]) }}
			{!! Form::close() !!}
		</div>
	</div>

@endsection