<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Repository\ScheduleRepository;
use App\Services\Schedule\ScheduleService;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    use JsonResponse;

    protected $model;
    protected $service;
    protected $repository;
    
    public function __construct(ScheduleRepository $repository, ScheduleService $service)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    /**
     * @OA\Get(
     *     path="/schedule",
     *     summary="List all schedulings for the authenticated user.",
     *     tags={"Schedule"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Listagem de agendamentos realizada com sucesso.", @OA\JsonContent())
     * )
     */
    public function index(Request $request)
    {
        try {
            $schedule = $this->service->getAll($request);

            return $this->success($schedule, "Listagem de agendamentos realizada com sucesso.");
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    /**
     * @OA\Get(
     *     path="/schedule/{id}",
     *     summary="Show a specific scheduling for the authenticated user.",
     *     tags={"Schedule"},
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
            $schedule = $this->service->find($id);

            return $this->success($schedule, "Agendamento recuperado com sucesso.");
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }


    /**
     * @OA\Post(
     *     path="/schedule",
     *     summary="Register a type.",
     *     tags={"Schedule"},
     *     @OA\Parameter(
     *         name="type_id",
     *         in="query",
     *         description="Type's ID",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *             name="title",
     *             in="query",
     *             description="Schedule's title",
     *             required=true,
     *             @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *             name="description",
     *             in="query",
     *             description="Schedule's description",
     *             required=true,
     *             @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *             name="starting_at",
     *             in="query",
     *             description="Starting Date",
     *             required=true,
     *             @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *             name="due_at",
     *             in="query",
     *             description="Due Date",
     *             required=true,
     *             @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *             name="conclusion_at",
     *             in="query",
     *             description="Conclusion Date",
     *             required=false,
     *             @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *             name="status",
     *             in="query",
     *             description="Status",
     *             required=true,
     *             @OA\Schema(type="string")
     *     ),
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Agendamento registrado com sucesso.", @OA\JsonContent())
     * )
     */
    public function store(Request $request)
    {
        try {
            $schedule = $this->service->store($request);

            return $this->success($schedule, "Agendamento registrado com sucesso.");
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    /**
     * @OA\Put(
     *     path="/schedule",
     *     summary="Register a Schedule.",
     *     tags={"Schedule"},
     *     @OA\Parameter(
     *         name="type_id",
     *         in="query",
     *         description="Type's ID",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *             name="title",
     *             in="query",
     *             description="Schedule's title",
     *             required=true,
     *             @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *             name="description",
     *             in="query",
     *             description="Schedule's description",
     *             required=true,
     *             @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *             name="starting_at",
     *             in="query",
     *             description="Starting Date",
     *             required=true,
     *             @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *             name="due_at",
     *             in="query",
     *             description="Due Date",
     *             required=true,
     *             @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *             name="conclusion_at",
     *             in="query",
     *             description="Conclusion Date",
     *             required=false,
     *             @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *             name="status",
     *             in="query",
     *             description="Status",
     *             required=true,
     *             @OA\Schema(type="string")
     *     ),
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Agendamento atualizado com sucesso.", @OA\JsonContent())
     * )
     */
    public function edit(Request $request, Schedule $schedule)
    {
        try {
            $schedule = $this->service->update($request, $schedule);

            return $this->success($schedule, "Agendamento atualizado com sucesso.");
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    /**
     * @OA\Delete(
     *     path="/schedule/{id}",
     *     summary="Delete a Schedule's register.",
     *     tags={"Schedule"},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Type's id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Agendamento excluído com sucesso.", @OA\JsonContent())
     * )
     */
    public function destroy(Schedule $schedule)
    {
        try {
            $schedule = $this->service->destroy($schedule);

            return $this->success($schedule, "Agendamento excluído com sucesso.");
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }
}
