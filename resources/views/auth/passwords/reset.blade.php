@extends('main')

@section('title', ' - Forgot my password')

@section('content')

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading"><strong><big>Reset Password</big></strong></div>
				<div class="panel-body">
					{!! Form::open(['url' => 'password/reset', 'method' => "POST", 'data-parsley-validate' => '']) !!}
					{{ Form::hidden('token', $token) }}
					{{ Form::label('email', 'Email Address:') }}
					{{ Form::email('email', $email, ['class' => 'form-control', 'placeholder' => 'Please enter your email', 'required' => '', 'maxlength' => '255']) }}
					{{ Form::label('password', 'New Password:') }}
					{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Please enter your password', 'required' => '', 'maxlength' => '255']) }}
					{{ Form::label('password_confirmation', 'Confirm New Password:') }}
					{{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Please retype your password to confirm', 'required' => '', 'maxlength' => '255']) }}
					{{ Form::submit('Reset Password', ['class' => 'btn btn-primary btn-spacing-top']) }}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>

@endsection