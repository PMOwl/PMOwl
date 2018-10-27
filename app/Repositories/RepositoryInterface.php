<?php
/**
 * Created by PhpStorm.
 * User: dongyuxiang
 * Date: 2017/3/29
 * Time: 18:29
 */

namespace App\Repositories;


interface RepositoryInterface
{
    public function all($columns = ['*']);
    public function paginate($perPage = 15, $columns = ['*']);
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
    public function find($id, $columns = ['*']);
    public function findBy($field, $value, $columns = ['*']);
}
