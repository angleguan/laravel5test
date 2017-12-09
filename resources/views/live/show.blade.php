@extends('layouts.default')

@section('title','Live详情')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="page-header">
                    <h3>{{ $live->title }}</h3>
                </div>
                <div>
                    <p>作者：{{ \App\User::findOrfail($live->user_id)->value('name') }}&nbsp;&nbsp;&nbsp;
                    开始结束时间：{{ $live->start_time }} —— {{ $live->end_time }}</p>

                </div>
                <div class="live-body">
                    {!! $live->content !!}
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

@endsection
