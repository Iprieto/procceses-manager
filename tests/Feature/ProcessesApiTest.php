<?php

namespace Tests\Feature;

use App\Contracts\ProcessRepositoryContract;
use App\Models\Process;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;
use Tests\TestCase;

class ProcessesApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testListAllTheProcesses()
    {
        $mock = \Mockery::mock(\App\Contracts\ProcessRepositoryContract::class);
        $mock->shouldReceive('getAllProcesses')->once()->andReturn(\App\Models\Process::factory()->count(4)->make());
        $this->app->instance(\App\Contracts\ProcessRepositoryContract::class, $mock);

        $response = $this->get('/api/v1/process');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStoreANewProcesses()
    {
        $response = $this->post('/api/v1/process/', \App\Models\Process::factory()->make()->getAttributes());

        $response->assertStatus(201);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShowAProcessesById()
    {        
        $process = \App\Models\Process::factory()->create();
        $response = $this->get('/api/v1/process/' . $process->id);

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStartAProcess()
    {        
        $process = \App\Models\Process::factory()->create();
        $response = $this->post("/api/v1/process/$process->id/start");

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStopAProcess()
    {        
        $process = \App\Models\Process::factory()->create([
            'status' => \App\Models\Process::STARTED,
            'started_at' => \Carbon\Carbon::now()
        ]);

        $response = $this->post("/api/v1/process/$process->id/finished");

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStopAProcessWhichHasNotBeenStarted()
    {        
        $process = \App\Models\Process::factory()->create();

        $response = $this->post("/api/v1/process/$process->id/finished");

        $response->assertStatus(500);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStartAProcessWhichHasBeenAlreadyFinished()
    {        
        $process = \App\Models\Process::factory()->create([
            'status' => \App\Models\Process::FINISHED,
            'started_at' => \Carbon\Carbon::now(),
            'finished_at' => \Carbon\Carbon::now()
        ]);

        $response = $this->post("/api/v1/process/$process->id/start");

        $response->assertStatus(500);
    }
}
