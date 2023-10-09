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

    public function index(Request $request)
    {
        try {
            $schedule = $this->service->getAll($request);

            return $this->success($schedule, "Listagem de agendamentos realizada com sucesso.");
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function show($id)
    {
        try {
            $schedule = $this->service->find($id);

            return $this->success($schedule, "Agendamento recuperado com sucesso.");
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function store(Request $request)
    {
        try {
            $schedule = $this->service->store($request);

            return $this->success($schedule, "Agendamento registrado com sucesso.");
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

    public function edit(Request $request, Schedule $schedule)
    {
        try {
            $schedule = $this->service->update($request, $schedule);

            return $this->success($schedule, "Agendamento atualizado com sucesso.");
        } catch (\Throwable $th) {
            return $this->error($th);
        }
    }

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
