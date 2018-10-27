<?php
/**
 * Created by PhpStorm.
 * User: dongyuxiang
 * Date: 2017/8/6
 * Time: 22:19
 */

namespace App\Utils;


use App\Constant\GlobalConst;
use Cache;
use Illuminate\Database\Eloquent\Model;

class EntityUtil
{
    const TOPIC = 'topic';

    /**
     * 对阅读数进行缓存和更改
     * @param Model $model
     * @param string $type
     */
    public static function updateHit(Model $model, $type)
    {
        $hitsCacheKey = $type . '-hits-' . $model->id;
        $hits = cache($hitsCacheKey);
        $hits = null == $hits ? 1 : $hits + 1;
        if ($hits >= GlobalConst::HIT_EXCEED) {
            $model->timestamps = false;
            $model->update(['view_count' => $model->view_count + $hits]);
            $model->timestamps = true;
            Cache::forever($hitsCacheKey, 0);
        } else {
            Cache::forever($hitsCacheKey, $hits);
        }
        return $hits === GlobalConst::HIT_EXCEED ? 0 : $hits;
    }

}