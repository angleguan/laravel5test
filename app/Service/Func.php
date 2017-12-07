<?php
namespace App\Service;

use Illuminate\Support\Facades\DB;

//用户自定义的逻辑方法
class Func{
    //获取所有live分类信息
    public static function  getLiveCategoryList(){
        return DB::table('live_category')
            ->where(['status' => 1 ])
            ->orderBy('sort','desc')
            ->get();
    }



}