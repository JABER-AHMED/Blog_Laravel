@extends('main')

@section('title', '| Registration Form')

@section('content')


	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					RegistrationForm
				</div>
			<div class="panel-body">
				<form method="POST" action="{{ route('user.register') }}">
				     <div class="form-group">
				     	<label>Firstname:</label>
				     	<input type="text" name="firstname" class="form-control">
				     </div>
				     <div class="form-group">
				     	<label>Lastname:</label>
				     	<input type="text" name="lastname" class="form-control">
				     </div>
				     <div class="form-group">
				     	<label>Email:</label>
				     	<input type="email" name="email" class="form-control">
				     </div>
				     <div class="form-group">
				     	<label>password:</label>
				     	<input type="password" name="password" class="form-control">
				     </div>
				     <div class="form-group">
				     	<label>Confirm password:</label>
				     	<input type="password" name="password_confirmation" class="form-control">
				     </div>
				     <button class="btn btn-primary btn-block">Submit</button>
				     <p style="margin-left: 30px; margin-top: 10px;">Already have an account?<a style="text-decoration: none;" href="{{ route('login') }}"> signIn to Blog</a></p>
				      {{ csrf_field() }}
				      
				</form>
			</div>
			</div>
		</div>
	</div>
	

@endsection