<?php

namespace App\Observers;

use App\Models\Topic;

class TopicObserver
{
    // creating, created, updating, updated, saving,
    // saved,  deleting, deleted, restoring, restored
    function saving(Topic $topic)
    {
        // 使用 mews/purifier 过滤 html 非法标签
        
        $topic->body = clean($topic->body, 'topic_body');
        $topic->excerpt = make_excerpt($topic->body);
    }
}
