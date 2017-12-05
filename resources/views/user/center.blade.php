@extends('layouts.default')

@section('title','用户中心')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <p>{{$user->name}}</p>
                <p>{{$user->email}}</p>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

@endsection