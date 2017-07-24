<?php

namespace App\Models;

use App\Models\ScopeTrait\PublicScopeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use PublicScopeTrait;
    use SoftDeletes;

    // Don't forget to fill this array
    protected $fillable = [
        'title',
        'slug',
        'body',
        'excerpt',
        'is_draft',
        'source',
        'body_original',
        'user_id',
        'category_id',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function lastReplyUser()
    {
        return $this->belongsTo(User::class, 'last_reply_user_id');
    }
}
