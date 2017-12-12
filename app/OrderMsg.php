<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMsg extends Model
{
    protected $table = "order_msg";
	
	 protected $fillable = ['user_id','live_id','content'];
   
}
