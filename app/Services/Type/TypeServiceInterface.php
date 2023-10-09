<?php

namespace App\Services\Type;

use App\Models\Type;
use Illuminate\Http\Request;

interface TypeServiceInterface
{
    public function getAll();

    public function find($id = null);

    public function destroy(Type $type): bool;

    public function store(Request $request): Type;

    public function update(Request $request, Type $type): bool;
}