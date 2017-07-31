<?php
/**
 * Created by PhpStorm.
 * User: dongyuxiang
 * Date: 2017/7/23
 * Time: 23:32
 */

namespace App\Services;


use App\Models\Topic;

class TopicServices
{
    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function getTopic($id)
    {
        $model = app(Topic::class);

        $result = $model::where('id', $id)->with('user')->firstOrFail();

        return $result;
    }

    /**
     * @param $filter
     * @param int $perPage
     * @return mixed
     */
    public function getTopicsWithFilter($filter, $perPage = 15)
    {
        $filter = $this->getTopicFilter($filter);

        return $this->applyFilter($filter)
            ->with('user', 'category', 'lastReplyUser')
            ->paginate($perPage);

    }

    /**
     * 分类过滤器安全性检查
     * @param $request_filter
     * @return string
     */
    private function getTopicFilter($requestFilter)
    {
        $filters = ['no-reply', 'vote', 'excellent', 'recent', 'excellent-pinned', 'index'];
        if (in_array($requestFilter, $filters)) {
            return $requestFilter;
        }
        return 'default';
    }

    /**
     * 根据过滤取数据
     * @param $filter
     * @return $this
     */
    private function applyFilter($filter)
    {
        $query = app(Topic::class);

        switch ($filter) {
            case 'no-reply':
                return $query->orderBy('order', 'desc')->orderBy('reply_count', 'asc')->orderBy('created_at', 'desc');
                break;
            case 'vote':
                return $query->orderBy('order', 'desc')->orderBy('vote_count', 'desc')->orderBy('created_at', 'desc');
                break;
            case 'excellent':
                return $query->where('is_excellent', true)->orderBy('created_at', 'desc');
                break;
            case 'recent':
                return $query->orderBy('order', 'desc')->orderBy('created_at', 'desc');
                break;
            case 'index':
            default:
                return $query->orderBy('order', 'desc')->orderBy('updated_at', 'desc')->orderBy('created_at', 'desc');
                break;
        }
    }


}