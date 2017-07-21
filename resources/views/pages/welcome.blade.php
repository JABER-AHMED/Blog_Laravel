@extends('main')

@section('title', '| Homepage')

@section('content')

    <div class="row">
        <div class="col-md-8">
         @foreach($posts as $post)
        <div class="post">
            <div class="panel panel-default">
                <div class="panel-body">
                <img src="{{ asset('uploads/avatars/'. $post->user->avatar) }}" style="height: 50px; width: 50px; top: 10px; border-radius: 50%; float:left;">
                    <h4 style="margin-top: 60px; color:#333;">{{ $post->title }}</h4>
                    <h5>{{ $post->user->firstname.' '. $post->user->lastname }}</h5>
                    <h5>Posted In: {{ $post->category->name }}</h5>
                    <h5>{{ $post->created_at }}</h5>
            <p>{{ substr(strip_tags($post->body), 0, 300) }} {{ strlen(strip_tags($post->body)) > 20 ? "..":"" }}</p>
            <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read More</a>
            <hr>
            <div class="tags">
                @foreach($post->tags as $tag)
                  <a href="{{ route('tags.show', $tag->id)}}"><span style="line-height: 20px; margin-right: 3px;" class="label label-primary">{{ $tag->name }}</span></a>
                @endforeach
            </div>

            <div class="comments"> 
            <a style="margin-top: 2px;" href="{{ route('blog.single', $post->slug)}}">{{ $post->comment()->count() }} Comments</a>
            </div>
            <div class="likes">
                <a class="like" style="float:right; margin-top: 2px; margin-right:10px; font-size: 14px; " href="">Like</a> |
                <a class="like" style="float:right; margin-top: 2px; margin-right:10px; font-size: 14px; " href="">Dislike</a>
            </div>
            </div>
            </div>
        </div>
            @endforeach
        </div>

        <div class="col-md-3">
        <div class="catagories">
        <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Catagories<h4>
        </div>
           <div class="panel-body">

           @foreach($categories as $category)

             <a href="{{ route('categories.show', $category->id )}}"><p style="font-size: 17px;">{{ $category->name }} ({{ $category->posts()->count() }})</p></a>

            @endforeach

            </div>
         </div>
        </div>
        <div class="tags">
        <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Tags<h4>
        </div>
           <div class="panel-body">

                  @foreach($tags as $tag)
                      <a href="{{ route('tags.show', $tag->id) }}"><span style="line-height: 20px; margin-right: 5px;" class="label label-md label-primary"><i class="fa fa-tag" aria-hidden="true"> {{ $tag->name }} </i></span></a>
                  @endforeach

            </div>
         </div>
        </div>
        </div>
    </div>
    <div class="text-center">
       {{ $posts->links() }}
    </div>

    <script>
        
        var token = '{{ Session::token() }}';
        var urlLike = '{{ route('like') }}';

    </script>

@endsection