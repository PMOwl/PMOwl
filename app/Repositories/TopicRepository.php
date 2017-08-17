<?php
/**
 * Created by PhpStorm.
 * User: dongyuxiang
 * Date: 2017/8/17
 * Time: 15:17
 */

namespace App\Repositories;


use App\Models\Topic;

class TopicRepository extends BaseRepository
{

    public function __construct(Topic $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
    }
}