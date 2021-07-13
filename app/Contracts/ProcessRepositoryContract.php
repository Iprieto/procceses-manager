<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface ProcessRepositoryContract
{
    /**
     * Get all processes
     * 
     */
    public function getAllProcesses();

    /**
     * Get all processes paginated
     * 
     */
    public function getAllProcessesPaginated();

    /**
     * Get process by ID
     * 
     */
    public function getProcessById($id);

    /**
     * Store a new process
     * 
     */
    public function storeProcess($request);

    /**
     * Update a process
     * 
     */
    public function updateProcess($request, $id);
}
