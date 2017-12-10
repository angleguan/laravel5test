@extends('layouts.default')

@section('title','编辑Live')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="form-header">编辑Live</div>
                <div class="form-body">
                    @include('layouts.errors')
                    @if(session()->has('danger'))
                        <div class="alert alert-danger">
                            {{session()->get('danger')}}
                        </div>
                    @endif

                    <form method="post" action="{{route('live.update',$live->id)}}">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="form-group">
                            <label for="">Live标题:</label>
                            <input type="text" value="{{$live->title}}" name="title" class="form-control" id="" placeholder="请输入Live标题">
                        </div>
                        <div class="form-group">
                            <label for="">Live所属分类:</label>
                            <select class="form-control" name="live_category_id">
                                @foreach(\App\Service\Func::getLiveCategoryList() as $category)
                                    @if($live->live_category_id === $category->id)
                                        <option value="{{$category->id}}" selected="selected">{{$category->name}}</option>
                                    @else
                                        <option value="{{$category->id}}" >{{$category->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Live内容:</label>
                            {!! we_css() !!}
                            <textarea class="form-control we-container" name="content" id="wangeditor" style="display:none;" cols="5" rows="10">
                                {{$live->content  }}
                             </textarea>
                            {!! we_js() !!}
                            {!! we_config('wangeditor') !!}
                        </div>
                        <div class="form-group">
                            <label for="">Live开始时间:</label>
                            <input type="text" value="{{$live->start_time}}" name="start_time" class="form-control" id="" placeholder="请输入Live开始时间">
                        </div>
                        <div class="form-group">
                            <label for="">Live结束时间:</label>
                            <input type="text" value="{{$live->end_time}}" name="end_time" class="form-control" id="" placeholder="请输入Live结束时间">
                        </div>
                        <button type="submit" class="btn btn-info">更新</button>
                    </form>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

@endsection
