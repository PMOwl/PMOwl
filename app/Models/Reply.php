<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lingxi\Hashids\ModelTraits\PublicId;

class Reply extends Model
{
    use PublicId;
    use SoftDeletes;

    protected $fillable = [
        'body',
        'source',
        'user_id',
        'topic_id',
        'body_original',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
