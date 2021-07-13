<?php

namespace App\Contracts;

use App\Models\Process;
use Illuminate\Http\Request;

/**
 * 
 */
interface ProcessServiceContract
{
    /**
     * Get all processes
     * 
     */
    public function getAllProcesses();

    /**
     * Get process by ID
     * 
     */
    public function getProcessById($id);

    /**
     * Update process
     * 
     */
    public function updateProcess($request, $id);

    /**
     * Destroy process
     * 
     */
    public function destroyProcess($id);

    /**
     * Store a new process
     * 
     */
    public function storeProcess($request);

    /**
     * Update process status to STARTED
     * 
     */
    public function startProcess($id);

    /**
     * Update process status to FINISHED
     * 
     */
    public function finishProcess($id);
}
