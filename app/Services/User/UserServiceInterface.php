<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Http\Request;

interface UserServiceInterface
{
    public function index();

    public function find($id = null);

    public function destroy(User $user): bool;

    public function store(Request $request, $data);

    public function update($data, User $user, Request $request): bool;
}