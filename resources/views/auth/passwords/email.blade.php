@extends('main')

@section('title', ' - Forgot my password')

@section('stylesheets')
		{{ Html::style('parsley/parsley.css') }}
@endsection

@section('content')

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading"><strong><big>Reset Password</big></strong></div>
				<div class="panel-body">
					@if(session('status'))
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Success!</strong> Please check your email inbox and click on the password reset link there to reset your password
						</div>
					@else
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Error!</strong>
							Password reset link can't be sent currently. Please try again later.
						</div>
					@endif
					{!! Form::open(['url' => 'password/email', 'method' => "POST", 'data-parsley-validate' => '']) !!}
					{{ Form::label('email', 'Email Address:') }}
					{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Please enter your email', 'required' => '', 'maxlength' => '255']) }}
					{{ Form::submit('Reset Password', ['class' => 'btn btn-primary btn-spacing-top']) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>

@endsection

@section('scripts')
	{!! Html::script('parsley/parsley.min.js') !!}
@endsection