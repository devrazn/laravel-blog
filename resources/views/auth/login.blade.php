@extends('main')

@section('title', ' - Login')

@section('stylesheets')
{{ Html::style('parsley/parsley.css') }}
@endsection


@section('content')

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		{!! Form::open(['data-parsley-validate' => '']) !!}
		{{ Form::label('email', "Email:") }}
    	{{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'Please enter email', 'required' => '', 'maxlength' => '255')) }}
    	{{ Form::label('password', "Password:") }}
    	{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Please enter password', 'required' => '', 'maxlength' => '60')) }}
    	{{ Form::checkbox('remember') }} {{ Form::label('remember', "Remember Me:") }}
    	<br>
    	{{ Form::submit('Login', ['class' => 'btn btn-primary btn-block']) }}
    	<p class="btn-nav"><a href="{{ url('password/reset') }}">Forgot Passowrd?</a></p>
		{!! Form::close() !!}
	</div>
</div>

@endsection

@section('scripts')
	{!! Html::script('parsley/parsley.min.js') !!}
@endsection