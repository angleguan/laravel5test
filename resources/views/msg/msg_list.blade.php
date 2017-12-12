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