<?php
/**
 * Created by PhpStorm.
 * User: dongyuxiang
 * Date: 2017/7/24
 * Time: 00:01
 */

namespace App\Models\ScopeTrait;


trait PublicScopeTrait
{
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}