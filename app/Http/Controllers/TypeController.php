<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Repository\TypeRepository;
use App\Services\Type\TypeService;
use Illuminate\Http\Request;

class TypeController extends Controller
{
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
 
            return response()->json([
                'success' => true,
                'data'    => $type,
                'message' => 'Listando tipos...',
            ]);
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function show($id)
    {
        try {
            $type = $this->service->find($id);

            return response()->json([
                'success' => true,
                'data'    => $type,
                'message' => 'Listando tipos...',
            ]);

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $type = $this->service->store($request);

            return response()->json([
                'success' => true,
                'data'    => $type,
                'message' => 'Listando tipos...',
            ]);

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function edit(Request $request, Type $type)
    {
        try {
            $type = $this->service->update($request, $type);

            return response()->json([
                'success' => true,
                'data'    => $type,
                'message' => 'Listando tipos...',
            ]);

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function destroy(Type $type)
    {
        try {
            $type = $this->service->destroy($type);

            return response()->json([
                'success' => true,
                'data'    => $type,
                'message' => 'Listando tipos...',
            ]);

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
