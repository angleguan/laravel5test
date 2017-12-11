<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Auth\Authenticatable;

use App\Live;

class LiveController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',[
            'only'=>['create','store']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('live.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //表单自动验证
        $this->validate($request,[
            'title' => 'required|max:255|unique:live',
            'content' => 'required|min:10',
            'start_time' => 'required|date',
            'end_time' => 'required|date'
        ],[
            'title.required' => 'Live标题不能为空！',
            'content.required' => 'Live内容不能为空！',
            'start_time.required' => 'Live开始时间不能为空！',
            'end_time.required' => 'Live结束时间不能为空！',
        ]);

        //日期的判断
        if(strtotime($request->start_time) > strtotime($request->end_time) || strtotime($request->start_time) < time()){
            return redirect()->back()->withInput()->withErrors('开始日期不合理,请查看！');
        }

        //组装数据
        $date = [
            'title' => $request->title,
            'live_category_id' => $request->live_category_id,
            'content' => $request->content,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 1,
            'user_id' => Auth::user()->id,
        ];

        $live = Live::create($date);//$live返回的是live新增表的id

        return redirect()->route('live.show',[$live]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //查live详情
        return view('live.show',['live'=>Live::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('live.edit',['live'=>Live::FindOrFail($id)]);
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
        //表单自动验证
        $this->validate($request,[
            'title' => 'required|max:255',
            'content' => 'required|min:10',
            'start_time' => 'required|date',
            'end_time' => 'required|date'
        ],[
            'title.required' => 'Live标题不能为空！',
            'content.required' => 'Live内容不能为空！',
            'start_time.required' => 'Live开始时间不能为空！',
            'end_time.required' => 'Live结束时间不能为空！',
        ]);

        //日期的判断
        if(strtotime($request->start_time) > strtotime($request->end_time) || strtotime($request->start_time) < time()){
            return redirect()->back()->withInput()->withErrors('开始日期不合理,请查看！');
        }

        $live = Live::findOrFail($id);

        //组装数据
        $date = [
            'title' => $request->title,
            'live_category_id' => $request->live_category_id,
            'content' => $request->content,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 1,
            'user_id' => Auth::user()->id,
        ];

        $live->update($date);

        return redirect()->route('live.show',[$id]);
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
