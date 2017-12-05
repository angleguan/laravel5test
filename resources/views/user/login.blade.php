@extends('layouts.default')

@section('title','用户登录')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="form-header">用户登录</div>
				<div class="form-body">
                   @include('layouts.errors')

                    @if(session()->has('danger'))
                        <div class="alert alert-danger">
                            {{session()->get('danger')}}
                        </div>
                    @endif

					<form method="post" action="{{route('login')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">邮箱:</label>
                            <input type="email" value="{{old('email')}}" name="email" class="form-control" id="exampleInputEmail1" placeholder="请输入邮箱">
                        </div>
						  <div class="form-group">
						    <label for="exampleInputPassword1">密码:</label>
						    <input type="password" value="{{old('password')}}" name="password" class="form-control" id="exampleInputPassword1" placeholder="请输入密码">
						  </div>
						  
						  <button type="submit" class="btn btn-info">登录</button>
					</form>
				</div>
			</div>		
		<div class="col-md-3"></div>	
	</div>
</div>

@endsection
