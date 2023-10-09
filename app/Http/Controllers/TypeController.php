<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Repository\TypeRepository;
use App\Services\Type\TypeService;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    use JsonResponse;

    protected $model;
    protected $service;
    protected $repository;
    
    public function __construct(TypeRepository $repository, TypeService $service)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {
            $type = $this->service->getAll($request);
 
            return $this->success($type, "Listagem de tipo de gendamento relizada com sucesso.");
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function show($id)
    {
        try {
            $type = $this->service->find($id);

            return $this->success($type, "Tipo de gendamento recuperado com sucesso.");
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function store(Request $request)
    {
        try {
            $type = $this->service->store($request);

            return $this->success($type, "Tipo de gendamento registrado com sucesso.");
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function edit(Request $request, Type $type)
    {
        try {
            $type = $this->service->update($request, $type);

            return $this->success($type, "Tipo de gendamento atualizado com sucesso.");
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function destroy(Type $type)
    {
        try {
            $type = $this->service->destroy($type);

            return $this->success($type, "Tipo de gendamento excluído com sucesso.");
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}
