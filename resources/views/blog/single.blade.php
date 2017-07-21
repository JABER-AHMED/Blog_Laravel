@extends('main')

<?php $titleTag = htmlspecialchars($post->title); ?>

@section('title', "| $titleTag")

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<img src="{{ asset('uploads/avatars/'. $post->user->avatar) }}" style="height: 60px; width: 60px; top: 10px; border-radius: 50%; float:left; margin-top: 5px;">
			<h1 style="margin-left: 70px;">{{ $post->title }}</h1>
			<p>{!! $post->body !!}</p>
			<img src="{{ asset('images/'. $post->image) }}">
			<p>Posted In: {{ $post->category->name }}</p>
			<div class="tags">
				@foreach($post->tags as $tag)
				<span class="label label-default">{{ $tag->name }}</span>
				@endforeach
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3 class="comment-title"><span class="glyphicon glyphicon-comment"></span>{{ $post->comment()->count() }} Comments</h3>
			@foreach($post->comment as $comment)
			  <div class="comment">
                <div class="author-info">
                	<img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) ."?d=mm" }}" class="author-image">
                	<div class="author-name">

		            	<h4>{{ $comment->name }}</h4>
		            	<p class="author-time">{{ date('l jS \of F Y h:i:s A', strtotime($comment->created_at)) }}</p>
    	
                	</div>
                </div>

                <div class="comment-content">
                	{!! $comment->comment !!}
                </div>

			  </div>

			@endforeach
		</div>
	</div>

	<div class="row">
		<div id="comment-form" class="col-md-8 col-md-offset-2" style="margin-top: 10px;">
			{{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) }}

			<div class="row">
				<div class="col-md-6">
					{{ Form::label('name', 'Name:') }}
					{{ Form::text('name', null, ['class' => 'form-control']) }}
				</div>

				<div class="col-md-6">
					{{ Form::label('email', 'Email:') }}
					{{ Form::text('email', null, ['class' => 'form-control']) }}
				</div>

				<div class="col-md-12">
					{{ Form::label('comment', 'Comment:') }}
					{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '4']) }}

					{{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top: 10px;']) }}
				</div>
			</div>

			{{ Form::close() }}
		</div>
	</div>

@endsection