<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

  /*  public function user_info(){
        //一对一的模型关联 User关联UserInf
        return $this->hasOne('App\UserInfo','user_id');
    }*/

    //我的粉丝列表
    public function follow_user(){
        return $this->belongsToMany('App\User','user_follow','user_id','follow_id');
    }

    //我的关注列表
    public function user_follow(){
        return $this->belongsToMany('App\User','user_follow','follow_id','user_id');
    }


    //关注
    public  function follow($user_ids){
        $user_ids = [$user_ids];//数组化,用于同时关注多人
        return $this->user_follow()->sync($user_ids,false);
    }

    //取消关注
    public  function unfollow($user_ids){
        $user_ids = [$user_ids];
        return $this->user_follow()->detach($user_ids);
    }

    //判断当前用户是否已经关注某用户
    public function isfollow($user_id){
        return $this->user_follow->contains($user_id);
    }

}
