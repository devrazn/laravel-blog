@extends('main')

@section('title', ' - Login')

@section('stylesheets')
{{ Html::style('parsley/parsley.css') }}
@endsection

@section('content')

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		{!! Form::open(['data-parsley-validate' => '']) !!}
		{{ Form::label('name', "Name:") }}
    	{{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Please enter your full name', 'required' => '', 'maxlength' => '255')) }}
    	{{ Form::label('email', "Email:") }}
    	{{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'Please enter your email', 'required' => '', 'maxlength' => '255')) }}
    	{{ Form::label('password', "Password:") }}
    	{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Please enter password', 'required' => '', 'maxlength' => '60')) }}
    	{{ Form::label('password_confirmation', "Confirm Password:") }}
    	{{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Please retype your password', 'required' => '', 'maxlength' => '60')) }}
    	<br>
    	{{ Form::submit('Register', ['class' => 'btn btn-success btn-block']) }}
		{!! Form::close() !!}

	</div>
</div>

@endsection

@section('scripts')
	{!! Html::script('parsley/parsley.min.js') !!}
@endsection