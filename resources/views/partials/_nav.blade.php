<nav class="navbar navbar-default">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Laravel Blog</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="{{ Request::is('/home') ? "active" : "" }}"><a href="/home">Home</a></li>
            <li class="{{ Request::is('about') ? "active": "" }}"><a href="/about">About</a></li>
            <li class="{{ Request::is('contact') ? "active": "" }}"><a href="/contact">Contact</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-left" style="margin-top: 8px;">
            
               <form action="/search" method="POST" role="search">
              {{ csrf_field() }}
              <div class="input-group">
                  <input type="text" class="form-control" name="q"
                      placeholder="Search"> <span class="input-group-btn">
                      <button type="submit" class="btn btn-default">
                          <span class="glyphicon glyphicon-search"></span>
                      </button>
                  </span>
              </div>
            </form>

          </ul>

          <ul class="nav navbar-nav navbar-right">

             @if(Auth::check())
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="position: relative; padding-left: 50px;">
              <img src="{{ asset('uploads/avatars/'. Auth::user()->avatar) }}" style="height: 32px; width: 32px; position: absolute; top: 10px; left: 10px; border-radius: 50%;">
               {{ Auth::user()->firstname.' '.Auth::user()->lastname}} <span class="caret"></span>
               </a>
              <ul class="dropdown-menu">
                <li><a href="{{ url('/profile') }}"><i class="glyphicon glyphicon-user"> Prifile</i></a></li>
                <li><a href="{{ route('posts.index') }}"><i class="glyphicon glyphicon-th"> My Posts</i></a></li>
                <li><a href="{{ route('categories.index') }}"><i class="glyphicon glyphicon-th-list"> Categories</i></a></li>
                <li><a href="{{ route('tags.index') }}"><i class="glyphicon glyphicon-tags"> tags</i></a></li>
                <li><a href="#" id="logout"><i class="glyphicon glyphicon-log-out"> Logout</i></a></li>
              </ul>
            </li>
            @else
            <a style="margin-top: 7px;" href="{{ route('login') }}" class="btn btn-default">Login</a>
            <a style="margin-top: 7px;" href="{{ route('register') }}" class="btn btn-default">SignUp</a>
            @endif
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
</nav>

<form id="formlogout" method="POST" action="{{ route('logout') }}">
    {!! csrf_field() !!}
</form>

<script>
  
  document
  .getElementById('logout')
  .addEventListener('click', function(e){
    e.preventDefault();
    document.getElementById('formlogout').submit();
  });

</script>