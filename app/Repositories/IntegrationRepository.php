<?php

namespace App\Repositories;

use App\Contracts\IntegrationContract;
use App\Models\Integration;

class IntegrationRepository extends BaseRepository implements IntegrationContract
{
    public function __construct()
    {
        $this->model = new Integration();
    }

    public function create(array $data): Integration
    {
        return $this->model->create($data);
    }
}
