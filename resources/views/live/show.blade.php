@extends('layouts.default')

@section('title','发布Live')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="page-header">
                    <h3>{{$live->title}}</h3>
                </div>
                <div>
                    <p>作者：<a href="{{route('user.show',$live->user_id)}}">{{\App\User::findOrFail($live->user_id)->value('name')}}</a>&nbsp;&nbsp;&nbsp;
                        开始结束时间：{{$live->start_time}} -- {{$live->end_time}}
                    </p>
                </div>
                <div>
                	@include('layouts.errors')
                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{session()->get('success')}}
                                </div>
                            @endif
                    @if(Auth::user())
                        @if(strtotime($live->start_time) < time())   
                        	<a href="{{route('msg.show',$live->id)}}" class="btn btn-info">进入Live</a>                                                              
                        @else
                           <form action="{{route('order.store')}}" method="post">
                                {{csrf_field()}}
                                <input  type="hidden" value="{{$live->id}}" name="live_id"/>
                                <input  type="hidden" value="{{Auth::user()->id}}" name="user_id"/>
                                <input type="submit"  value="马上预约" name="" class="btn btn-danger"/>
                            </form>
                        @endif
                    @else
                        <p>请<a href="{{route('login')}}">登录</a>后再预约Live</p>
                    @endif
                </div>
                <hr/>
                <div class="live-body">
                    {!! $live->content !!}
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

@endsection
