<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\ProcessServiceContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    private $processServiceContract;

    public function __construct(ProcessServiceContract $processServiceContract)
    {
        $this->processService = $processServiceContract;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->processService->getAllProcesses();
        
        // To get the results paginated use this one:
        // return $this->processService->getAllProcessesPaginated();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->processService->storeProcess($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        return $this->processService->getProcessById($uuid);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        return $this->processService->updateProcess($request, $uuid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        return $this->processService->destroyProcess($uuid);
    }

    /**
     * Update process status to start
     *
     * @param  Uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function start($uuid)
    {
        return $this->processService->startProcess($uuid);
    }

    /**
     * Update process status to finished
     *
     * @param  Uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function finished($uuid)
    {
        return $this->processService->finishProcess($uuid);
    }
}
