<?php

namespace Database\Factories;

use App\Models\Process;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProcessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Process::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => 'VOWELS_COUNT',
            'input' => $this->faker->realText(100),
            'output' => null,
            'status' => 'NOT_STARTED',
            'started_at' => null,
            'finished_at' => null,
        ];
    }
}
