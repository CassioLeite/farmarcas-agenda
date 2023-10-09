<?php

namespace App\Repository;

use App\Models\Schedule;

class ScheduleRepository extends AbstractRepository
{
    protected $model;

    public function __construct(Schedule $schedule)
    {
        $this->model = $schedule;
    }

    public function index($userId)
    {
        return $this->model->where('user_id', '=', $userId)->get();
    }

    public function find($id = null)
    {
        return $this->model->find($id);
    }

    public function store($data): Schedule
    {
        return $this->model->create($data);
    }

    public function update($id, $data): bool
    {
        $schedule = $this->model->find($id);

        return $schedule->update([
            'user_id' => $data['user_id'],
            'type_id' => $data['type_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
            'starting_at' => $data['starting_at'],
            'due_at' => $data['due_at'],
            'conclusion_at' => $data['conclusion_at'],
        ]);
    }

    public function destroy($id): bool
    {
        return $this->find($id)->delete();
    }

    public function schedulingAtExistingSchedule($startingAt, $dueAt): bool
    {
        return $this->model->whereBetween('starting_at', [$startingAt, $dueAt])->exists();
    }
}