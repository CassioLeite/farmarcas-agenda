<?php

namespace App\Services\Schedule;

use App\Enums\Status;
use App\Models\Schedule;
use App\Models\Type;
use App\Repository\ScheduleRepository;
use App\Repository\TypeRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleService implements ScheduleServiceInterface
{
    protected $model;
    protected $repository;
    protected $typeRepository;

    public function __construct(ScheduleRepository $repository, TypeRepository $typeRepository, Schedule $model)
    {
        $this->model = $model;
        $this->repository = $repository;
        $this->typeRepository = $typeRepository;
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

    public function store(Request $request): Schedule
    {
        $this->userHasAccessToSchedule($request);
        $this->verifyIfScheduleIsValid($request);

        return $this->repository->store($request->all());
    }

    public function update(Request $request, Schedule $schedule): bool
    {
        $this->userHasAccessToSchedule($request);
        $this->verifyIfScheduleIsValid($request);
        $this->checkClosingSchedule($request);

        $request->merge(['user_id' => Auth::user()->id]);
        $result = $this->repository->update($schedule->id, $request->all());

        return $result;
    }

    protected function checkClosingSchedule(Request $request): void
    {
        if ($request->status === Status::CLOSED->value) {
            $request->merge(['conclusion_at' => date('Y-m-d H:i:s')]);
        }
    }

    public function destroy(Schedule $schedule): bool
    {
        return $this->repository->destroy($schedule->id);
    }

    protected function verifyIfScheduleIsValid(Request $request): void
    {
        if ($this->isWeekend($request)) {
            throw new Exception("O agendamento não pode ser feito no final de semana.", 400);
        }

        if (!$this->checkType($request->type_id)) {
            throw new Exception("O tipo que você está tentando associar a um agendamento não existe.", 400);
        }

        if ($this->schedulingAtExistingSchedule($request)) {
            throw new Exception("Já existe agendamentos para a data selecionada.", 400);
        }
    }

    protected function isCreate(Request $request) {
        return $request->isMethod('post');
    }

    protected function isWeekend(Request $request): bool
    {
        return (date('N', strtotime($request->starting_at)) >= 6) ||
                (date('N', strtotime($request->due_at)) >= 6);
    }

    protected function schedulingAtExistingSchedule(Request $request): bool
    {
        if ($this->isCreate($request)) {
            return $this->repository->schedulingAtExistingSchedule($request->starting_at, $request->due_at);
        }

        return false;
    }

    protected function checkType($id): Type | null
    {
        return $this->typeRepository->find($id);
    }

    protected function userHasAccessToSchedule(Request $request)
    {
        $userId = Auth::user()->id;

        if ($userId != $request->user_id) {
            throw new Exception("O correu um erro ao tentar atualizar o agendamento.", 403);
        }
    }
}