<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplies extends Model
{
    use HasFactory;
    protected $fillable = [
        "project_id",
        "supply_name",
        "supply_description",
        "supply_count",
        "supply_price",
        "supply_status"
    ];
}
