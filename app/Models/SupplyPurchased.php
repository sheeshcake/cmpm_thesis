<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyPurchased extends Model
{
    use HasFactory;
    protected $table = "supply_purchased";
    protected $fillable = [
        "supply_id",
        "store_purchased",
        "supply_count_purchased",
        "supply_price"
    ];
}
