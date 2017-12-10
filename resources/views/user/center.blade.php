@extends('layouts.default')

@section('title','用户中心')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="page-header">
                    <h3>用户中心</h3>
                </div>
                <div style="border-bottom: 1px solid #eee;line-height: 50px">
                    <P>
                        用户名：{{$user->name}}
                    </P>
                    <P>
                        粉丝数：{{count($follow_user_list)}}
                    </P>
                    <P>
                        关注数：{{count($user_follow_list)}}
                    </P>
                    <p>
                        @if(Auth::user()->id !== $user->id)
                            @if(Auth::user()->isfollow($user->id))
                                 <form method="post" action="{{route('follow.unfollow',$user->id)}}">
                                    {{csrf_field()}}
                                     {{method_field('DELETE')}}
                                    <input type="submit" value="取消关注" class="btn btn-info">
                                 </form>
                            @else
                                <form method="post" action="{{route('follow.follow',$user->id)}}">
                                    {{csrf_field()}}
                                    <input type="submit" value="关注" class="btn btn-info">
                                </form>
                            @endif
                        @endif
                    </p>
                </div>
                <br/><br/>
{{--------------------------------------------------------------}}


            <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a href="#a" data-toggle="tab">我发布的Live</a></li>
                <li><a href="#b" data-toggle="tab">我购买的Live</a></li>
                <li><a href="#c" data-toggle="tab">我的粉丝</a></li>
                <li><a href="#d" data-toggle="tab">我的关注</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="a">
                    @if(count($lives)>0)
                        @foreach($lives as $live)
                            <div class="user_live_list" style="line-height: 30px;border-bottom: 1px solid #eee;">
                                <h4><a href="{{route('live.show',$live->id)}}">{{$live->title}}</a></h4>
                                <p>
                                    @if(Auth::user()->id == $user->id)
                                        <a href="{{route('live.edit',$live->id)}}" class="btn btn-info">编辑</a>
                                    @endif
                                </p>
                            </div>
                        @endforeach
                        {!! $lives->render() !!}}
                    @else
                        <div>
                            <p>暂无Live发布</p>
                        </div>
                    @endif
                </div>
                <div class="tab-pane fade" id="b">
                   <p>暂无pay</p>
                </div>
                <div class="tab-pane fade" id="c">
                    @if(count($follow_user_list)>0)
                        @foreach($follow_user_list as $user)
                            <p><a href="{{route('user.show',$user->id)}}">{{$user->name}}</a></p>
                        @endforeach
                    @else
                        <p>暂无粉丝</p>
                    @endif
                </div>
                <div class="tab-pane fade" id="d">
                    @if(count($user_follow_list)>0)
                        @foreach($user_follow_list as $follow)
                            <p><a href="{{route('user.show',$follow->id)}}">{{$follow->name}}</a></p>
                        @endforeach
                    @else
                        <p>暂无关注</p>
                    @endif
                </div>
            </div>




 {{----------------------------------------------------------}}
            </div>
            <div class="col-md-2"></div>
        </div>



@endsection