<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_position",
        "user_status",
        "user_degree",
        "user_contact_number",
        "user_current_address",
        "user_address",
        "user_gender",
        "user_birthday",
        "user_place_of_birth",
        "user_civil_status",
        "user_height",
        "user_weight",
        "user_religion",
        "user_elementary",
        "user_highschool",
        "user_college",
        "user_sss",
        "user_tin",
        "user_nbi",
        "user_passport",
        "user_rate",
        "user_income",
        "user_id"
    ];


}
