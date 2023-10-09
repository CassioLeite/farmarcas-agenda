<?php

namespace App\Repository;

use App\Models\Type;

class TypeRepository extends AbstractRepository
{
    protected $model;

    public function __construct(Type $type)
    {
        $this->model = $type;
    }

    public function index()
    {
        return $this->model->get();
    }

    public function find($id = null)
    {
        return $this->model->find($id);
    }

    public function store($data): Type
    {
        return $this->model->create($data);
    }

    public function update($id, $data): bool
    {
        $type = $this->model->find($id);

        return $type->update([
            'description' => $data['description']
        ]);
    }

    public function destroy($id): bool
    {
        return $this->find($id)->delete();
    }
}