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
                    用户名：{{$user->name}}
                </div>
                <div class="page-header">
                    <h3>我的Live列表</h3>
                </div>
               <div>
                   @if(count($lives)>0)
                       @foreach($lives as $live)
                           <div class="user_live_list" style="line-height: 30px;border-bottom: 1px solid #eee;">
                                <h4><a href="{{route('live.show',$live->id)}}">{{$live->title}}</a></h4>
                               <p>
                                   <a href="{{route('live.edit',$live->id)}}" class="btn btn-info">编辑</a>
                               </p>
                           </div>
                       @endforeach
                   @else
                       <div>
                           暂无Live发布
                       </div>
                   @endif
               </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

@endsection