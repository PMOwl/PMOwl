<?php
/**
 * Created by PhpStorm.
 * User: dongyuxiang
 * Date: 2017/8/10
 * Time: 15:58
 */

namespace App\Repositories;


use App\Models\User;

class UserRepository extends BaseRepository
{
    /**
     * @var User $model
     */
    protected $model;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        /** @var User $model */
        $model = new $this->model($data);

        $model->save();

        return $model->getQueueableId();
    }
}