<?php

namespace App\Repositories;

use App\Contracts\BaseContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseRepository implements BaseContract
{
    protected \Illuminate\Database\Eloquent\Model $model;

    abstract public function __construct();

    public function list(string $order = 'id', string $sort = 'desc', array $columns = ['*'], int $limit = 0): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->orderBy($order, $sort)
            ->when($limit > 0, function (Builder $query) use ($limit) {
                return $query->limit($limit);
            })
            ->get($columns);
    }

    public function find(int|string $id): ?\Illuminate\Database\Eloquent\Model
    {
        return $this->model->find($id);
    }

    public function findOneOrFail(int $id): ?\Illuminate\Database\Eloquent\Model
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $params): \Illuminate\Database\Eloquent\Model
    {
        return $this->model->create($params);
    }

    public function update(array $params): bool
    {
        return $this->model->update($params);
    }

    public function delete(int $id): bool
    {
        return $this->model->destroy($id);
    }
}
