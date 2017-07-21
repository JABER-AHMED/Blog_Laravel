@extends('main')

@section('title', '| Edit Tags')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
			    <img src="{{ asset('uploads/avatars/'. $user->avatar) }}" style="width:150px; height: 150px; float:left; border-radius:50%; margin-right: 25px;">
				<h3>{{ $user->firstname." ".$user->lastname}}'s Profile</h3>
				<form action="/profile" method="POST" enctype="multipart/form-data">
					<label>Update Profile Image</label>
					<input type="file" name="avatar">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="submit" class="btn btn-sm btn-primary">
				</form>
			</div>
		</div>
	</div>

@endsection