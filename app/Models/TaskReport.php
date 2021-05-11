<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskReport extends Model
{
    use HasFactory;
    protected $table = "task_report";
    protected $fillable = [
        'task_id',
        'user_id',
        'task_details',
        'task_picture'
    ];
}

