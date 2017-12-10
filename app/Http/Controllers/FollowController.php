<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\User;

use Auth;


class FollowController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',[
            'only'=>[
                'store',
                'destroy',
            ]
        ]);
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
    public function store($id)
    {
        $user = User::findOrFail($id);

        //不能关注自己
        if(Auth::user()->id == $user->id){
            return redirect()->route('/');
        }

        //不能重复关注
        if(!Auth::user()->isfollow($user->id)){
            Auth::user()->follow($user->id);
        }

        return redirect()->route('user.show',$user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        $user = User::findOrFail($id);

        //不能关注自己
        if(Auth::user()->id == $user->id){
            return redirect()->route('/');
        }


        if(Auth::user()->isfollow($user->id)){
            Auth::user()->unfollow($user->id);
        }

        return redirect()->route('user.show',$user->id);
    }
}
