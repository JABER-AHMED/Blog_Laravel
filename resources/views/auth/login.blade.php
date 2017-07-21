@extends('main')

@section('title', '| Login Form')

@section('content')

	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					LoginForm
				</div>
			<div class="panel-body">
				<form method="POST" action="{{ route('auth.login') }}">
				     <div class="form-group">
				     	<label>Email:</label>
				     	<input type="email" name="email" class="form-control">
				     </div>
				     <div class="form-group">
				     	<label>password:</label>
				     	<input type="password" name="password" class="form-control">
				     </div>
				     <button class="btn btn-success btn-block">Submit</button>

				      {{ csrf_field() }}
				      
				</form>
			</div>
			</div>
		</div>
	</div>

@endsection