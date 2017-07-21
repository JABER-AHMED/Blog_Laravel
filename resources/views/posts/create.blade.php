@extends('main')

@section('title', '| Create New Post')

@section('stylesheets')

	{!! Html::style('css/parsey.css') !!}


@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<h1>Create New Post</h1>
		<hr>
			{!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '', 'files' => 'true']) !!}

    			{{ Form::label('title', 'Title:') }}
    			{{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

    			{{ Form::label('slug', 'Slug:') }}
    			{{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) }}

    			{{ Form::label('category_id', 'Category:') }}
    			<select name="category_id" class="form-control">
    			   @foreach($categories as $category)
    				<option value="{{ $category->id }}">{{ $category->name}}</option>
    			   @endforeach
    			</select>

                {{ Form::label('tags', 'Tags:') }}
                <select class="form-control select2-multi" name="tags[]" multiple="multiple">
                   @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name}}</option>
                   @endforeach
                </select>

                {{ Form::label('featured_image', 'Upload Featured Image:') }}
                {{ Form::file('featured_image') }}

    			{{ Form::label('body', 'Form Body:') }}
    			{{ Form::textarea('body', null, array('class' => 'form-control', 'required' => '')) }}

    			{{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px')) }}
			{!! Form::close() !!}
			
		</div>
	</div>

@endsection

@section('scripts')

	{!! Html::style('js/parsey.min.js') !!}

    <script type="text/javascript" >
        $(".select2-multi").select2();
    </script>

@endsection