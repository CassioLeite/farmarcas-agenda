<?php

namespace App\Services\Schedule;

use App\Models\Schedule;
use Illuminate\Http\Request;

interface ScheduleServiceInterface
{
    public function getAll();

    public function find($id = null);

    public function destroy(Schedule $schedule): bool;

    public function store(Request $request): Schedule;

    public function update(Request $request, Schedule $schedule): bool;
}