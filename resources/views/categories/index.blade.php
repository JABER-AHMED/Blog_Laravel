@extends('main')

@section('title', '| All Categories')

@section('content')

	<div class="row">
		<div class="col-md-8">
		<h1>Categories</h1>
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
				</tr>
			</thead>
			<tbody>
			    @foreach ($categories as $category)
				<tr>
					<th>{{ $category->id }}</th>
					<td>{{ $category->name }}</td>
				</tr>
				@endforeach
			</tbody>
		  </table>
		</div> <!-- End of col-md-8 -->

		<div class="col-md-3">
			<div class="well">
				<form action="{{ route('categories.store') }}" method="POST">
				<h2>New Category</h2>
					<label>Category</label>
					<input type="text" name="category" class="form-control">
					<button class="btn btn-success btn-block btn-h1-spacing">Add Category</button>

					{{ csrf_field() }}
					
				</form>
			</div>
		</div>
	</div>

@stop