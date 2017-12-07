<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    //设置表名
    protected $table = 'live';

    //fillable表示在create()方法中可以被赋值的字段
    protected $fillable = [
        'title',
        'live_category_id',
        'content',
        'start_time',
        'end_time',
        'user_id',
        'status'
    ];
}
