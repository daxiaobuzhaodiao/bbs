<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count',
        'last_reply_user_id', 'order', 'excerpt', 'slug'
    ];

    public function scopeWithOrder($query, $order) 
    {
        switch($order){
            case 'recent_created_at';
                $query->recentCreatedAt();
                break;
            case 'recent_replied';
                $query->recentReplied();
                break;
        }
        return $query;
    }

    public function scopeRecentCreatedAt($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeRecentReplied($query)
    {
        // 有新回复时，会更新 reply_count 字段，会自动触发框架更新 updated_at 字段
        return $query->orderBy('updated_at', 'desc');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

}