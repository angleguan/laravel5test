@extends('layouts.default')

@section('title','用户注册')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="form-header">用户注册</div>
				<div class="form-body">
                    @include('layouts.errors')
					<form method="post" action="{{ route('user.store') }}">
						{{csrf_field()}}
						  <div class="form-group">
						    <label for="exampleInputText1">用户名:</label>
						    <input type="text" name="name" class="form-control" id="exampleInputText1" placeholder="请输入用户名">
						  </div>
						  <div class="form-group">
							<label for="exampleInputEmail1">邮箱:</label>
							<input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="请输入邮箱">
						  </div>
						  <div class="form-group">
						    <label for="exampleInputPassword1">密码:</label>
						    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="请输入密码">
						  </div>
						  <div class="form-group">
						    <label for="exampleInputPassword1">重复密码:</label>
						    <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="请输入密码">
						  </div>
						  						 
						  <button type="submit" class="btn btn-info">注册</button>
					</form>
				</div>
		</div>		
		<div class="col-md-3"></div>	
	</div>
</div>

@endsection