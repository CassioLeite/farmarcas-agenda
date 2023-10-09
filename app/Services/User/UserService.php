<?php

namespace App\Services\User;

use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class UserService implements UserServiceInterface
{
    protected $model;
    protected $repository;

    public function __construct(UserRepository $repository, User $model)
    {
        $this->model = $model;
        $this->repository = $repository;
        //$this->vendorRepository = $vendorRepository;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function find($id = null)
    {
        return $this->repository->find($id);
    }

    public function store(Request $request, $data): User
    {
        $data['password'] = bcrypt('Passw0rd!');
        //$data['type'] = $this->getType($data);
        $user = $this->repository->store($data);
        return $user;
    }

    public function update($data, User $user, Request $request): bool
    {
        if (isset($data['password'])) {
            if (isset($data['new_password'])) {
                $data['password'] = bcrypt($data['new_password']);
            } else {
                $data['password'] = bcrypt($data['password']);
            }
        } else {
            unset($data['password']);
        }

        $result =  $this->repository->update( $user->id, $data);

        return $result;
    }

    public function destroy(User $user): bool
    {
        return $this->repository->destroy($user);
    }
}