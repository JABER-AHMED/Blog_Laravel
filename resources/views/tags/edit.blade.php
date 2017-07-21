@extends('main')

@section('title', '| Edit Tags')

@section('content')

	{{ Form::model($tags, ['route' => ['tags.update', $tags->id], 'method' => "PUT"]) }}

		{{ Form::label('name', 'Name:') }}
		{{ Form::text('name', null, ['class' => 'form-control']) }}

		{{ Form::submit('Save Changes', ['class' => 'btn btn-success', 'style' => 'margin-top:10px;']) }}

	{{ Form::close() }}

@endsection