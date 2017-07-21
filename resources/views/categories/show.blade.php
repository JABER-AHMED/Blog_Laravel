@extends('main')

@section('title', '| Homepage')

@section('content')

    <div class="row">
        <div class="col-md-8">
         @foreach($category->posts as $post)
        <div class="post">
            <div class="panel panel-default">
                <div class="panel-body">
                <img src="{{ asset('uploads/avatars/'. $post->user->avatar) }}" style="height: 50px; width: 50px; top: 10px; border-radius: 50%; float:left;">
                    <h3 style="margin-top: 60px;">{{ $post->title }}</h3>
                    <h5>{{ $post->created_at }}</h5>
                    <h5>Posted In: {{ $post->category->name }}</h5>
            <p>{{ substr(strip_tags($post->body), 0, 300) }} {{ strlen(strip_tags($post->body)) > 20 ? "..":"" }}</p>
            <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read More</a>
            <hr>
            <div class="tags">
                @foreach($post->tags as $tag)
                  <span style="padding: 5px;" class="label label-default">{{ $tag->name }}</span>
                @endforeach
            </div>

            <div class="comments">  
            <a href="{{ route('blog.single', $post->slug)}}">{{ $post->comment()->count() }} Comments</a>
            </div>
            </div>
            </div>
        </div>
            @endforeach
        </div>
    </div>
@endsection