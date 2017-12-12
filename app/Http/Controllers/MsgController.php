<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Live;

use Auth;

use App\Order;

use App\OrderMsg;


class MsgController extends Controller
{
	public function __contstrust(){
		$this->middleware('auth');
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
        	'content'=>'required|max:1000',
        ],[
        	'content.required'=>'内容或答案不能为空',
        ]);
		
		$data = [
			'user_id'=>$request->user_id,
			'live_id'=>$request->live_id,		
			'content'=>$request->content		
		];
		
		OrderMsg::create($data);

		return redirect()->back();
		
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //用户必须已经预约
		$map['user_id'] = Auth::user()->id;
        $map['live_id'] = $id;
		$order = new Order();
		$order_info = $order->where($map)->value('id');
		if($order_info === null){
			return redirect()->back()->withInput()->withErrors('未预约');
		}
        
		//查询当前live的msg列表
		$liveMsg = new OrderMsg; 
		$msg_list = $liveMsg->where(['live_id'=>$id])->get();
		
        $live = Live::findOrFail($id);
        return view('msg.show',['live'=>$live,"msg_list"=>$msg_list]);
    }



	//ajax异步通信
	public function getMsgList($id){		
		$liveMsg = new OrderMsg; 
		$msg_list = $liveMsg->where(['live_id'=>$id])->get();
		     
        return view('msg.msg_list',["msg_list"=>$msg_list]);
			
	}



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
