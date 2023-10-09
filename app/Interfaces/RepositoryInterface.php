<?php

namespace App\Interfaces;

interface RepositoryInterface
{
    public function index($id);
    public function find($id = null);
    public function store($data);
    public function update($id, $data): bool;
    public function destroy($id): bool;
}