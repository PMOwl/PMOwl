<?php
/**
 * Created by PhpStorm.
 * User: dongyuxiang
 * Date: 2017/8/17
 * Time: 15:09
 */

namespace App\Repositories;


use App\Models\Reply;

class RepliesRepository extends BaseRepository
{
    public function __construct(Reply $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $data['user_id'] = \Auth::id();

        /** @var Reply $model */
        $model = new $this->model($data);

        $model->save();

        return $model->getQueueableId();
    }
}