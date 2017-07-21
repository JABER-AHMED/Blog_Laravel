@extends('main')

@section('title', '| Delete Comment')


@section('content')

	<h1>Delete This comment</h1>

	<p>
		
		<strong>Name:</strong>{{ $comment->name }}<br>
		<strong>Email:</strong>{{ $comment->email }}<br>
		<strong>Comment:</strong>{{ $comment->comment }}

	</p>

	{{ Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) }}

	   {{ Form::submit('Delete Comment', ['class' => 'btn btn-danger btn-block btn-lg']) }}

	{{ Form::close() }}

@stop