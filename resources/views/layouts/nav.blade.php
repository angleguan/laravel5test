<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">问答</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            @foreach(\App\Service\Func::getLiveCategoryList() as $category )
                 <li><a href="{{ url('/category_id',$category->id) }}">{{$category->name}}</a></li>
            @endforeach
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
      	<form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="请输入需要检索的内容">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
      </form>

        @if(Auth::check())
              <li><a href="{{route('live.create')}}">发布Live</a></li>
              <li><a href="{{route('user.show',Auth::user()->id)}}">{{Auth::user()->name}}</a></li>
              <li>
                  <form class="navbar-form navbar-left" method="post" action="{{route('logout')}}">
                      {{csrf_field()}}
                      {{method_field('DELETE')}}
                      <button type="submit" class="btn btn-default">注销</button>
                  </form>
              </li>
        @else
              <li><a href="{{route('login')}}">登录</a></li>
              <li><a href="{{route('user.create')}}">注册</a></li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>