<?php

namespace App\Services;

use App\Contracts\MakeResponsesContract;
use App\Contracts\ProcessRepositoryContract;
use App\Contracts\ProcessServiceContract;
use App\Http\Resources\ProcessCollection;
use App\Http\Resources\ProcessResource;
use App\Models\Process;
use App\Traits\InteractsWithResponses;
use Carbon\Carbon;

/**
 * 
 */
class ProcessService implements ProcessServiceContract, MakeResponsesContract
{
    use InteractsWithResponses;
    
    private $processRepositoryContract;

    public function __construct(ProcessRepositoryContract $processRepositoryContract)
    {
        $this->processRepository = $processRepositoryContract;
    }

    public function getAllProcesses()
    {
        try {
            return $this->success("All Processes", 
                $this->processRepository->getAllProcesses()
            );
        } catch(\Exception $e) {
            return $this->error('Internal Server Error', 500);
        }
    }

    public function getAllProcessesPaginated()
    {
        try {
            return $this->success("All Processes Paginated", 
                $this->processRepository->getAllProcessesPaginated()
            );
        } catch(\Exception $e) {
            return $this->error('Internal Server Error', 500);
        }
    }

    public function getProcessById($id)
    {
        try {
            $process = $this->processRepository->getProcessById($id);
            if(!$process) return $this->error("No process with ID $id", 404);
            
            return $this->success("Process Detail", $process);

        } catch(\Exception $e) {
            return $this->error('Internal Server Error', 500);
        }
    }

    public function updateProcess($request, $process)
    {
        return $this->error("Method Not Allowed", 405);
    }

    public function destroyProcess($process)
    {
        return $this->error("Method Not Allowed", 405);
    }
    
    public function storeProcess($request)
    {
         try {
            $process = [
                'type' => $request->type,
                'input' => $request->input,
                'status' => $request->status,
            ];
            if ($request->start) {
                $process['started_at'] = Carbon::now();
                $process['status'] = Process::STARTED;
            }
            $process = $this->processRepository->storeProcess($process);
            return $this->success("Created", $process, 201);
        } catch(\Exception $e) {
            return $this->error('Internal Server Error', 500);
        }
    }

    public function startProcess($id)
    {
        try {
            $process = $this->processRepository->getProcessById($id);
            if (!is_null($process->started_at)) return $this->error("The process has already started", 500);

            $data = [
                'status' => Process::STARTED,
                'started_at' => Carbon::now()
            ];
            $process = $this->processRepository->updateProcess($data, $id);
            return $this->success("The process has started successfully", $process);
        } catch (\Exception $e) {
            return $this->error('Internal Server Error', 500);
        }
    }

    public function finishProcess($id)
    {
        try {
            $process = $this->processRepository->getProcessById($id);
            if (!is_null($process->finished_at)) return $this->error("The process has already finished", 500);
            if (is_null($process->started_at)) return $this->error("The process has not start yet", 500);
            
            $data = [
                'status' => Process::FINISHED,
                'finished_at' => Carbon::now()
            ];
            $process = $this->processRepository->updateProcess($data, $id);
            return $this->success("The process has finished successfully", $process);
        } catch (\Exception $e) {            
            return $this->error('Internal Server Error', 500);
        }
    }
}
