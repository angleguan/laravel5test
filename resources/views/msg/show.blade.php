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
                <hr/>
                @include('layouts.errors')
                        <div id='scrolldIV' style="border: 1px solid #ddd;height: 300px;padding: 10px;box-sizing: border-box;border-radius: 5px;overflow: auto;">
                        @if(count($msg_list)<=0)	
                        	<p>当前无任何live消息</p>
                        @else	
                        	@foreach($msg_list as $msg)
                        	<div>
                        		<p>用户：{{$msg->user_id}}</p>
                        		<p>{{$msg->content}}</p>
                        		<hr/>
                        	</div> 
                        	@endforeach
                        @endif                     	
                        </div>
                        <br/>                      
                        <form action="{{route('msg.store')}}" method="post">  
                        	{{csrf_field()}}
                        	<input type="hidden" name="live_id"  value="{{$live->id}}" /> 
                        	<input type="hidden" name="user_id"  value="{{Auth::user()->id}}" />  
                        	<textarea class='form-control' name="content" cols="10"></textarea>  <br/>                   
                        	<input type="submit" class="btn btn-info btn-block" value="提交问题" />
                        </form>                    
                </div>             
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
	<script>
		$(function(){
			setInterval(function(){
				
				$.get("{{route('getMsgList',$live->id)}}",
				{ time:new Date().getTime() },
				function(data){
					if(data){
						$('#scrolldIV').html(new Date().getTime()+":"+data);
					}
				})	
										
			},2000);
			
		})
	</script>
@endsection
