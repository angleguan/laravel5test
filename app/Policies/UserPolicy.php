<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\User;



class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * desc 判断模型的id是否和用户登录的id一致
     * @param User $login_user 当前系统已经登录的用户对象，id，name
     * @param User $find_user 传入的查询用户对象 id，name
     */
    public function check(User $login_user , User $find_user)
    {
        return $login_user->id == $find_user->id;
    }
}
