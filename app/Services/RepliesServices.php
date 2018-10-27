<?php
/**
 * Created by PhpStorm.
 * User: dongyuxiang
 * Date: 2017/8/17
 * Time: 14:58
 */

namespace App\Services;


use App\Repositories\RepliesRepository;
use App\Repositories\TopicRepository;
use Auth;

class RepliesServices
{

    /**
     * @param $data
     * @return mixed
     */
    public function storeReply($data)
    {
        $replyId = app(RepliesRepository::class)->create($data);

        $topic = app(TopicRepository::class)->find($data['topic_id']);
        $topic->last_reply_user_id = Auth::id();
        $topic->reply_count++;
        $topic->save();

        return $replyId;
    }

}
