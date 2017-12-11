<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Order;

use Auth;

use App\User;

use App\Live;

class OrderController extends Controller
{
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
        //数据验证
        $this->validate($request,[
            'user_id'=>'required',
            'live_id'=>'required',
        ]);

        //不能预约自己的live
        $live = Live::findOrFail($request->live_id);
        if($live->user_id === Auth::user()->id){
            return redirect()->back()->withInput()->withErrors('请勿预约自己的Live');
        }

        //live只能预约一次
        $map['user_id'] = $request->user_id;
        $map['live_id'] = $request->live_id;
        $order = new Order();
        $order_info = $order->where($map)->value('user_id');
        if($order_info !== null){
            return redirect()->back()->withInput()->withErrors('已经预约');
        }

        //数据构建
        $data = [
            'user_id' => $request->user_id,
            'live_id' => $request->live_id,
            'pay_at' => date('Y-m-d H:i:s')
        ];

        Order::create($data);

        session()->flash('success','预约成功');
        return redirect()->route('live.show',[$request->live_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
