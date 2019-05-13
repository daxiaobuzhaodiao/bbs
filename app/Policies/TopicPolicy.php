<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Topic;

class TopicPolicy
{
    use HandlesAuthorization;

    public function isOwnerOf(User $currentUser, Topic $topic)
    {
        return $currentUser->id === $topic->user_id;
    }
}
