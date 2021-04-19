<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_id',
        'task_name',
        'task_status',
        'task_priority',
        'user_id',
        'task_date_start',
        'task_date_end'
    ];
}
