<?php

namespace App\Observers;

use App\Models\Topic;

class TopicObserver
{
    // creating, created, updating, updated, saving,
    // saved,  deleting, deleted, restoring, restored
    function saving(Topic $topic)
    {
        $topic->excerpt = make_excerpt($topic->body);
    }
}
