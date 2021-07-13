<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory, Uuids;

    const NOT_STARTED = 'NOT_STARTED';
    const STARTED = 'STARTED';
    const FINISHED = 'FINISHED';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'type',
        'input',
        'output',
        'status',
        'started_at',
        'finished_at',
    ];
}
