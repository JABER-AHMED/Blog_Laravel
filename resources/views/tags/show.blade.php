@extends('main')

@section('title', '| $tags->name Tag')

@section('content')

     <div class="row">
     	<div class="col-md-8">
     		<h1>{{ $tags->name }} Tag <small>{{$tags->posts()->count() }}</small></h1>
     	</div>
     	<div class="col-md-2">
     		<a href="{{ route('tags.edit', $tags->id) }}" class="btn btn-primary btn-block pull-right" style="margin-top: 20px;">Edit</a>
     	</div>
          <div class="col-md-2">
               {{ Form::open(['route' => ['tags.destroy', $tags->id], 'method' => 'DELETE']) }}

                    {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block', 'style' => 'margin-top: 20px;']) }}

               {{ Form::close() }}
          </div>
     </div>
     <div class="row">
     	<div class="col-md-12">
     		<table class="table">
     			<thead>
     				<tr>
     					<th>#</th>
     					<th>Title</th>
     					<th>Tags</th>
     					<th>Action</th>
     				</tr>
     			</thead>
     			<tbody>
     			@foreach($tags->posts as $post)
     				<tr>
     					<td>{{ $post->id }}</td>
     					<td>{{ $post->title }}</td>
     					<td>@foreach($post->tags as $tag)
     							<span class="label label-default">{{ $tag->name }}</span>
     						@endforeach
     					</td>
     					<td><a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-sm">View</a></td>
     				</tr>
     			@endforeach
     			</tbody>
     		</table>
     	</div>
     </div>

@endsection