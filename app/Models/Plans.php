<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_name',
        'plan_date_start',
        'plan_date_end',
        'plan_priority',
        'plan_dependency',
    ];
}
