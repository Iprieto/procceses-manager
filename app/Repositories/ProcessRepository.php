<?php

namespace App\Repositories;

use App\Contracts\ProcessRepositoryContract;
use App\Models\Process;

/**
 * 
 */
class ProcessRepository implements ProcessRepositoryContract
{
    /**
     * Get all processes
     * 
     */
    public function getAllProcesses()
    {
        return Process::all();
    }

    /**
     * Get all processes paginated
     * 
     */
    public function getAllProcessesPaginated()
    {
        return Process::paginate();
    }

    /**
     * Get process by ID
     * 
     */
    public function getProcessById($id)
    {
        return Process::findOrFail($id);
    }

    /**
     * Store a new process
     * 
     */
    public function storeProcess($process)
    {
        return Process::create($process);
    }

    /**
     * Update a process
     * 
     */
    public function updateProcess($request, $id)
    {
        $process = $this->getProcessById($id);
        return $process->update($request);
    }
}
