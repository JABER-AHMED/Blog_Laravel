@extends('main')

@section('title', '| All Tags')

@section('content')

	<div class="row">
		<div class="col-md-8">
		<h1>Tags</h1>
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
				</tr>
			</thead>
			<tbody>
			    @foreach ($tags as $tag)
				<tr>
					<th>{{ $tag->id }}</th>
					<td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
				</tr>
				@endforeach
			</tbody>
		  </table>
		</div> <!-- End of col-md-8 -->

		<div class="col-md-3">
			<div class="well">
				<form action="{{ route('tags.store') }}" method="POST">
				<h2>New Tag</h2>
					<label>Tag</label>
					<input type="text" name="tag" class="form-control">
					<button class="btn btn-success btn-block btn-h1-spacing">Add Tag</button>

					{{ csrf_field() }}
					
				</form>
			</div>
		</div>
	</div>

@stop