<?php

namespace App\Repositories;

use App\Contracts\UserContract;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserContract
{
    public function __construct()
    {
        $this->model = new User();
    }

    public function findByEmail(string $email): ?Model
    {
        $this->model = $this->model->where('email', $email)->first();
        return $this->model;
    }
}
