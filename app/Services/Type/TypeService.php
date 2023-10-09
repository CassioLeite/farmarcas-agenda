<?php

namespace App\Services\Type;

use App\Models\Type;
use App\Repository\TypeRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeService implements TypeServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(TypeRepository $repository, Type $model)
    {
        $this->model = $model;
        $this->repository = $repository;
    }

    public function getAll()
    {
        $userId = Auth::user()->id;
        return $this->repository->index($userId);
    }

    public function find($id = null)
    {
        return $this->repository->find($id);
    }

    public function store(Request $request): Type
    {
        $request->merge(['user_id' => Auth::user()->id]);
        return $this->repository->store($request->all());
    }

    public function update(Request $request, Type $type): bool
    {
        $result = $this->repository->update($type->id, $request->all());

        return $result;
    }

    public function destroy(Type $type): bool
    {
        return $this->repository->destroy($type->id);
    }
}