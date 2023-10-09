<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Repository\ScheduleRepository;
use App\Services\Schedule\ScheduleService;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
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

            return response()->json([
                'success' => true,
                'data'    => $schedule,
                'message' => 'Listando tipos...',
            ]);
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function show($id)
    {
        try {
            $schedule = $this->service->find($id);

            return response()->json([
                'success' => true,
                'data'    => $schedule,
                'message' => 'Listando tipos...',
            ]);

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $schedule = $this->service->store($request);

            return response()->json([
                'success' => true,
                'data'    => $schedule,
                'message' => 'Listando tipos...',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => true,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function edit(Request $request, Schedule $schedule)
    {
        try {
            $schedule = $this->service->update($request, $schedule);

            return response()->json([
                'success' => true,
                'data'    => $schedule,
                'message' => 'Listando tipos...',
            ]);

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function destroy(Schedule $schedule)
    {
        try {
            $schedule = $this->service->destroy($schedule);

            return response()->json([
                'success' => true,
                'data'    => $schedule,
                'message' => 'Listando tipos...',
            ]);

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
