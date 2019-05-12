<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count',
        'last_reply_user_id', 'order', 'excerpt', 'slug'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

}