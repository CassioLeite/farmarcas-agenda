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

    /**
     * @OA\Get(
     *     path="/type",
     *     summary="List all types of scheduling for the authenticated user.",
     *     tags={"Type"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Listagem de tipo de gendamento relizada com sucesso.", @OA\JsonContent())
     * )
     */
    public function index(Request $request)
    {
        try {
            $type = $this->service->getAll($request);
 
            return $this->success($type, "Listagem de tipo de gendamento relizada com sucesso.");
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    /**
     * @OA\Get(
     *     path="/type/{id}",
     *     summary="Show a specific type of scheduling for the authenticated user.",
     *     tags={"Type"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Type's id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Tipo de gendamento recuperado com sucesso.", @OA\JsonContent())
     * )
     */
    public function show($id)
    {
        try {
            $type = $this->service->find($id);

            return $this->success($type, "Tipo de gendamento recuperado com sucesso.");
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    /**
     * @OA\Post(
     *     path="/type",
     *     summary="Register a type.",
     *     tags={"Type"},
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Type's description",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\MediaType(
     *                 mediaType="multipart/form-data",
     *                 @OA\Schema(
     *                     type="object",
     *                     @OA\Property(property="description", type="string", example="Esportes"),
     *                 ),
     *             ),
     *         ),
     *     ),
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Tipo de gendamento registrado com sucesso.", @OA\JsonContent())
     * )
     */
    public function store(Request $request)
    {
        try {
            $type = $this->service->store($request);

            return $this->success($type, "Tipo de gendamento registrado com sucesso.");
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    /**
     * @OA\Put(
     *     path="/type/{id}",
     *     summary="Edit a Type's register.",
     *     tags={"Type"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Type's id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\MediaType(
     *                 mediaType="multipart/form-data",
     *                 @OA\Schema(
     *                     type="object",
     *                     @OA\Property(property="description", type="string", example="Esportes"),
     *                 ),
     *             ),
     *         ),
     *     ),
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Tipo de gendamento atualizado com sucesso.", @OA\JsonContent())
     * )
     */
    public function edit(Request $request, Type $type)
    {
        try {
            $type = $this->service->update($request, $type);

            return $this->success($type, "Tipo de gendamento atualizado com sucesso.");
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    /**
     * @OA\Delete(
     *     path="/type/{id}",
     *     summary="Delete a Type's register.",
     *     tags={"Type"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Type's id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Tipo de gendamento excluído com sucesso.", @OA\JsonContent())
     * )
     */
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
