<?php

namespace App\Repository;

use App\Models\User;

class UserRepository extends AbstractRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return '';
    }

    public function find($id = null)
    {
        return '';
    }

    public function store($data)
    {
        return '';
    }

    public function update($id, $data): bool
    {
        return '';
    }

    public function destroy($id): bool
    {
        return '';
    }
}