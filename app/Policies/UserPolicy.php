<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param $currentUser 固有参数，是当前的登陆用户对象，
     * @param $user 是控制器传来的被操作的用户对象
     */
    public function isSelf(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }
}
